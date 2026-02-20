"use strict";

$(function () {
    iniciarComponentes();
});

const iniciarComponentes = (form = "") => {
}

$(document).on('click', '#btnGantt', function () {
    const config = {
        'method': 'GET',
        'headers': {
            'Accept': generalidades.CONTENT_TYPE_JSON,
        },
    }

    const success = (response) => {
        if (response.estado == 'success') {
            // iniciarGanttDlhsoft(response.ganttDlhsoft);
            iniciarGanttDhtmlx(response.ganttDhtmlx);
        }
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    const error = (response) => {
        generalidades.ocultarCargando('body');
        generalidades.toastrGenerico(response?.estado, response?.mensaje);
    }

    generalidades.mostrarCargando('body');
    generalidades.get(route('proyectos.gantt', { proyecto: window.id_proyecto }), config, success, error);
});

const iniciarGanttDlhsoft = (ganttData) => {
    // Query string syntax: ?theme
    // Supported themes: Default, Generic-bright, Generic-blue, Royal-blue, DlhSoft-gray, Purple-green, Steel-blue, Dark-black, Cyan-green, Blue-navy, Orange-brown, Teal-green, Purple-beige, Gray-blue, Aero.
    var queryString = window.location.search;
    var theme = queryString ? queryString.substr(1) : null;

    // Retrieve and store the control element for reference purposes.
    var ganttChartView = document.querySelector('#ganttChartView');

    // Prepare data items.
    var date = new Date(), year = date.getFullYear(), month = date.getMonth();
    var items = ganttData;

    // Prepare control settings.
    var settings = {
        // Set the current time value to automatically scroll to a specific chart coordinate, and display a vertical bar highlighter at the specified point.
        currentTime: new Date(year, month, 2, 12, 0, 0)
    };

    // Optionally, set labels visibility.
    settings.areStandardTaskLabelsVisible = true;
    settings.areSummaryTaskLabelsVisible = true;
    settings.areMilestoneTaskLabelsVisible = true;

    // Prepare the columns collection.
    var columns = DlhSoft.Controls.GanttChartView.getDefaultColumns(items, settings);
    var indexOffset = columns[0].isSelection ? 1 : 0;

    // Optionally, add supplemental columns.
    columns.splice(0 + indexOffset, 0, { header: '', width: 40, cellTemplate: DlhSoft.Controls.GanttChartView.getIndexColumnTemplate() });
    columns.splice(3 + indexOffset, 0, { header: 'Duracion (h)', width: 80, cellTemplate: DlhSoft.Controls.GanttChartView.getTotalEffortColumnTemplate(64) });

    // Apply the customized columns collection.
    settings.columns = columns;

    // Optionally, set up auto-scheduling behavior for dependent tasks based on predecessor information, supplementary disallowing circular dependencies, either for all tasks or excluding started items and/or milestones.
    settings.areTaskDependencyConstraintsEnabled = true;

    // Optionally, initialize custom themes (themes.js).
    initializeGanttChartTheme(settings, theme);

    // Initialize the component.
    DlhSoft.Controls.GanttChartView.initialize(ganttChartView, items, settings);

    // Optionally, update the current time line periodically, e.g. every 5 minutes.
    // setInterval(function () { ganttChartView.updateCurrentTime(); }, 5 * 60 * 1000);

    // Define user command functions.
    function addNewItem() {
        var item = { content: 'New task', start: new Date(year, month, 2, 8, 0, 0), finish: new Date(year, month, 4, 16, 0, 0) };
        ganttChartView.addItem(item);
        ganttChartView.selectItem(item);
        ganttChartView.scrollToItem(item);
        ganttChartView.scrollToDateTime(new Date(year, month, 1));
        refreshOtherViews();
    }
    function insertNewItem() {
        if (ganttChartView.selectedItem == null)
            return;
        var item = { content: 'New task', start: new Date(year, month, 2, 8, 0, 0), finish: new Date(year, month, 4, 16, 0, 0) };
        ganttChartView.insertItem(ganttChartView.selectedItem.index, item);
        ganttChartView.selectItem(item);
        ganttChartView.scrollToItem(item);
        ganttChartView.scrollToDateTime(new Date(year, month, 1));
        refreshOtherViews();
    }
    function increaseItemIndentation() {
        var item = ganttChartView.selectedItem;
        if (item == null)
            return;
        ganttChartView.increaseItemIndentation(item);
        ganttChartView.scrollToItem(item);
        refreshOtherViews();
    }
    function decreaseItemIndentation() {
        var item = ganttChartView.selectedItem;
        if (item == null)
            return;
        ganttChartView.decreaseItemIndentation(item);
        ganttChartView.scrollToItem(item);
        refreshOtherViews();
    }
    function deleteItem() {
        if (ganttChartView.selectedItem == null)
            return;
        ganttChartView.removeItem(ganttChartView.selectedItem, true); // Also remove successors' predecessor information.
        refreshOtherViews();
    }
    function setCustomBarColorToItem() {
        if (ganttChartView.selectedItem == null)
            return;
        var item = ganttChartView.selectedItem;
        item.barStyle = 'stroke: Green; fill: LightGreen';
        item.completedBarStyle = 'stroke: Gray; fill: Gray';
        ganttChartView.refreshChartItem(item);
        refreshOtherViews();
    }
    function copyItem() {
        if (ganttChartView.selectedItem == null)
            return;
        copiedItem = ganttChartView.selectedItem;
    }
    var copiedItem = null;
    function pasteItem() {
        if (copiedItem == null || ganttChartView.selectedItem == null)
            return;
        var item = { content: copiedItem.content, start: copiedItem.start, finish: copiedItem.finish, completedFinish: copiedItem.completedFinish, isMilestone: copiedItem.isMilestone, assignmentsContent: copiedItem.assignmentsContent, isRelativeToTimezone: copiedItem.isRelativeToTimezone };
        ganttChartView.insertItem(ganttChartView.selectedItem.index + 1, item);
        ganttChartView.selectItem(item);
        ganttChartView.scrollToItem(item);
        ganttChartView.scrollToDateTime(item.start);
        refreshOtherViews();
    }
    function moveItemUp() {
        if (ganttChartView.selectedItem == null)
            return;
        var item = ganttChartView.selectedItem;
        ganttChartView.moveItemHierarchyUp(item);
        ganttChartView.scrollToItem(item);
        refreshOtherViews();
    }
    function moveItemDown() {
        if (ganttChartView.selectedItem == null)
            return;
        var item = ganttChartView.selectedItem;
        ganttChartView.moveItemHierarchyDown(item);
        ganttChartView.scrollToItem(item);
        refreshOtherViews();
    }
    function increaseTimelinePage() {
        ganttChartView.increaseTimelinePage(4 * 7 * 24 * 60 * 60 * 1000); // 4 weeks
        refreshOtherViews();
    }
    function decreaseTimelinePage() {
        ganttChartView.decreaseTimelinePage(4 * 7 * 24 * 60 * 60 * 1000); // 4 weeks
        refreshOtherViews();
    }
    function setCustomScales() {
        var settings = ganttChartView.settings;
        settings.headerHeight = 21 * 3;
        settings.scales = [{ scaleType: 'NonworkingTime', isHeaderVisible: false, isHighlightingVisible: true, highlightingStyle: 'stroke-width: 0; fill: #f8f8f8; fill-opacity: 0.65' },
        { scaleType: 'Months', headerTextFormat: 'Month', headerStyle: 'padding: 2.25px; border-right: solid 1px White; border-bottom: solid 1px White; color: gray; white-space: nowrap; overflow: hidden; text-overflow: ellipsis', isSeparatorVisible: true, separatorStyle: 'stroke: #c8bfe7; stroke-width: 0.5px' },
        { scaleType: 'Weeks', headerTextFormat: 'Date', headerStyle: 'padding: 2.25px; border-right: solid 1px White; border-bottom: solid 1px White; color: gray', isSeparatorVisible: true, separatorStyle: 'stroke: #c8bfe7; stroke-width: 0.5px' },
        { scaleType: 'Days', headerTextFormat: 'Day', headerStyle: 'padding: 2.25px; border-right: solid 1px White; color: gray' },
        { scaleType: 'CurrentTime', isHeaderVisible: false, isSeparatorVisible: true, separatorStyle: 'stroke: #e31d3b; stroke-width: 0.5px' }];
        settings.updateScale = 60 * 60 * 1000; // 1 hour
        settings.hourWidth = 5;
        settings.visibleWeekStart = 1; // Monday
        settings.visibleWeekFinish = 5; // Friday
        settings.workingWeekStart = 1; // Monday
        settings.workingWeekFinish = 4; // Thursday
        settings.visibleDayStart = 10 * 60 * 60 * 1000; // 10 AM
        settings.visibleDayFinish = 20 * 60 * 60 * 1000; // 8 PM
        settings.specialNonworkingDays = [new Date(year, month, 24), new Date(year, month, 25)];
        ganttChartView.refresh();
        refreshOtherViews();
    }
    function zoomIn() {
        var settings = ganttChartView.settings;
        ganttChartView.setHourWidth(settings.hourWidth * 2);
        refreshOtherViews();
    }
    function toggleBaseline() {
        var settings = ganttChartView.settings;
        settings.isBaselineVisible = !settings.isBaselineVisible;
        toggleBaselineCommand.className = settings.isBaselineVisible ? 'ribbonCommand toggle pressed' : 'ribbonCommand toggle';
        ganttChartView.refresh();
    }
    function highlightCriticalPath() {
        highlightCriticalPathCommand.className = 'ribbonCommand toggle pressed';
        for (var i = 0; i < ganttChartView.items.length; i++) {
            var item = ganttChartView.items[i];
            delete item.barStyle;
            if (!item.hasChildren && ganttChartView.isItemCritical(item))
                item.barStyle = 'stroke: #e31d3b; fill: #e31d3b';
            ganttChartView.refreshChartItem(item);
        }
    }
    function splitRemainingWork() {
        if (ganttChartView.selectedItem == null)
            return;
        var remainingWorkItem = ganttChartView.splitRemainingWork(ganttChartView.selectedItem, ' (rem. work)', ' (compl. work)');
        if (remainingWorkItem == null)
            return;
        ganttChartView.scrollToItem(remainingWorkItem);
        refreshOtherViews();
    }
    function toggleDependencyConstraints() {
        var settings = ganttChartView.settings;
        settings.areTaskDependencyConstraintsEnabled = !settings.areTaskDependencyConstraintsEnabled;
        toggleDependencyConstraintsCommand.className = settings.areTaskDependencyConstraintsEnabled ? 'ribbonCommand toggle pressed' : 'ribbonCommand toggle';
        ganttChartView.refresh();
        refreshOtherViews();
    }
    function levelResources() {
        // Level the assigned resources for all tasks, including the already started ones, considering the current time displayed in the chart.
        ganttChartView.levelResources(true, ganttChartView.settings.currentTime);
        // Alternatively, optimize work to obtain the minimum project finish date and time assuming unlimited resource availability:
        // ganttChartView.optimizeWork(false, true, ganttChartView.settings.currentTime);
    }
    function scheduleChart() {
        var scheduleChartPanel = document.querySelector('#scheduleChartPanel');
        scheduleChartPanel.style.display = 'inherit';
        var scheduleChartItems = ganttChartView.getScheduleChartItems();
        var scheduleChartSettings = { isReadOnly: true, selectionMode: 'None', isMouseWheelZoomEnabled: false };
        ganttChartView.copyCommonSettings(scheduleChartSettings);
        var scheduleChartView = document.querySelector('#scheduleChartView');
        initializeGanttChartTheme(scheduleChartSettings, theme);
        DlhSoft.Controls.ScheduleChartView.initialize(scheduleChartView, scheduleChartItems, scheduleChartSettings);
        scheduleChartSettings.displayedTimeChangeHandler = function (displayedTime) { refreshViewsDisplayedTime('ScheduleChart', displayedTime); }
        scheduleChartSettings.splitterPositionChangeHandler = function (gridWidth, chartWidth) { refreshViewsSplitterPosition('ScheduleChart', gridWidth, chartWidth); }
    }
    function closeScheduleChartView() {
        var scheduleChartPanel = document.querySelector('#scheduleChartPanel');
        scheduleChartPanel.style.display = 'none';
    }
    function loadChart() {
        var loadChartPanel = document.querySelector('#loadChartPanel');
        loadChartPanel.style.display = 'inherit';
        var loadChartItems = ganttChartView.getLoadChartItems();
        var loadChartSettings = { selectionMode: 'None', isMouseWheelZoomEnabled: false };
        ganttChartView.copyCommonSettings(loadChartSettings);
        var loadChartView = document.querySelector('#loadChartView');
        initializeLoadChartTheme(loadChartSettings, theme);
        DlhSoft.Controls.LoadChartView.initialize(loadChartView, loadChartItems, loadChartSettings);
        loadChartSettings.displayedTimeChangeHandler = function (displayedTime) { refreshViewsDisplayedTime('LoadChart', displayedTime); }
        loadChartSettings.splitterPositionChangeHandler = function (gridWidth, chartWidth) { refreshViewsSplitterPosition('LoadChart', gridWidth, chartWidth); }
        refreshLoadChartResourceSelector();
    }
    function closeLoadChartView() {
        var loadChartPanel = document.querySelector('#loadChartPanel');
        loadChartPanel.style.display = 'none';
    }
    function pertChart() {
        var pertChartPanel = document.querySelector('#pertChartPanel');
        pertChartPanel.style.display = 'inherit';
        // Optionally, pass 0 as method parameter to generate a lighter diagram for root tasks only.
        var pertChartItems = ganttChartView.getPertChartItems();
        var pertChartSettings = { chartMargin: 2, snapRearrangedItemsToGuidelines: false };
        var pertChartView = document.querySelector('#pertChartView');
        initializePertChartTheme(pertChartSettings, theme);
        DlhSoft.Controls.Pert.PertChartView.initialize(pertChartView, pertChartItems, pertChartSettings);
        var criticalItems = pertChartView.getCriticalItems();
        for (var i = 0; i < criticalItems.length; i++) {
            var item = criticalItems[i];
            item.shapeStyle = 'stroke: #e31d3b; fill: White';
            pertChartView.refreshItem(item);
        }
        // Optionally, reposition end nodes in order to get better visualization.
        // pertChartView.repositionEnds();
    }
    function closePertChartView() {
        var pertChartPanel = document.querySelector('#pertChartPanel');
        pertChartPanel.style.display = 'none';
    }
    function networkDiagram() {
        var networkDiagramPanel = document.querySelector('#networkDiagramPanel');
        networkDiagramPanel.style.display = 'inherit';
        // Optionally, pass 0 as method parameter to generate a lighter diagram for root tasks only.
        var networkDiagramItems = ganttChartView.getNetworkDiagramItems();
        var networkDiagramSettings = { diagramMargin: 2, snapRearrangedItemsToGuidelines: false };
        var networkDiagramView = document.querySelector('#networkDiagramView');
        initializePertChartTheme(networkDiagramSettings, theme);
        DlhSoft.Controls.Pert.NetworkDiagramView.initialize(networkDiagramView, networkDiagramItems, networkDiagramSettings);
        var criticalItems = networkDiagramView.getCriticalItems();
        for (var i = 0; i < criticalItems.length; i++) {
            var item = criticalItems[i];
            item.shapeStyle = 'stroke: #e31d3b; fill: White';
            networkDiagramView.refreshItem(item);
        }
        // Optionally, reposition end nodes in order to get better visualization.
        // networkDiagramView.repositionEnds();
    }
    function closeNetworkDiagramView() {
        var networkDiagramPanel = document.querySelector('#networkDiagramPanel');
        networkDiagramPanel.style.display = 'none';
    }
    function projectStatistics() {
        var startOutput = ganttChartView.getOutputDate(ganttChartView.getProjectStart()).toDateString();
        var finishOutput = ganttChartView.getOutputDate(ganttChartView.getProjectFinish()).toDateString();
        var hourDuration = 60 * 60 * 1000;
        var rounding = 100;
        var effortOutput = Math.round(ganttChartView.getProjectTotalEffort() / hourDuration * rounding) / rounding;
        var completionOutput = Math.round(ganttChartView.getProjectCompletion() * 100 * rounding) / rounding;
        var costOutput = Math.round(ganttChartView.getProjectCost() * rounding) / rounding;
        alert('Project statistics:\nStart: ' + startOutput + '\nFinish: ' + finishOutput + '\nEffort: ' + effortOutput + 'h\nCompl.: ' + completionOutput + '%\nCost: $' + costOutput);
    }
    function loadProjectXml() {
        closeSaveProjectXml();
        var loadProjectXmlPanel = document.querySelector('#loadProjectXmlPanel');
        loadProjectXmlPanel.style.display = 'inherit';
        var loadProjectXmlInput = document.querySelector('#loadProjectXmlInput');
        loadProjectXmlInput.focus();
        loadProjectXmlInput.select();
    }
    function loadProjectXmlContent() {
        var projectSerializer = DlhSoft.Controls.GanttChartView.ProjectSerializer.initialize(ganttChartView);
        var loadProjectXmlInput = document.querySelector('#loadProjectXmlInput');
        projectSerializer.loadXml(loadProjectXmlInput.value);
        closeLoadProjectXml();
    }
    function closeLoadProjectXml() {
        var loadProjectXmlPanel = document.querySelector('#loadProjectXmlPanel');
        loadProjectXmlPanel.style.display = 'none';
    }
    function saveProjectXml() {
        closeLoadProjectXml();
        var saveProjectXmlPanel = document.querySelector('#saveProjectXmlPanel');
        saveProjectXmlPanel.style.display = 'inherit';
        var projectXmlSerializerSettings = { compact: true, spaceSeparated: true };
        var projectSerializer = DlhSoft.Controls.GanttChartView.ProjectSerializer.initialize(ganttChartView, projectXmlSerializerSettings);
        var saveProjectXmlOutput = document.querySelector('#saveProjectXmlOutput');
        saveProjectXmlOutput.value = projectSerializer.getXml();
        saveProjectXmlOutput.focus();
        saveProjectXmlOutput.select();
    }
    function closeSaveProjectXml() {
        var saveProjectXmlPanel = document.querySelector('#saveProjectXmlPanel');
        saveProjectXmlPanel.style.display = 'none';
    }
    function print() {
        // Print the task hierarchy column and a selected timeline page of 5 weeks (timeline end week extensions would be added automatically, if necessary).
        // Optionally, to rotate the print output and simulate Landscape printing mode (when the end user keeps Portrait selection in the Print dialog), append the rotate parameter set to true to the method call: rotate: true.
        ganttChartView.print({ title: 'Gantt Chart (printable)', isGridVisible: true, columnIndexes: [1], timelineStart: new Date(year, month, 1), timelineFinish: new Date(new Date(year, month, 1).valueOf() + 5 * 7 * 24 * 60 * 60 * 1000), preparingMessage: '...' });
    }

    // Optionally, synchronize other displayed views upon standard Gantt Chart item or displayed time changes on the client side.
    var originalItemPropertyChangeHandler = settings.itemPropertyChangeHandler;
    settings.itemPropertyChangeHandler = function (item, propertyName, isDirect, isFinal) {
        if (isDirect && isFinal && ((!item.hasChildren && (propertyName == 'content' || propertyName == 'start' || propertyName == 'finish' || propertyName == 'completedFinish' || propertyName == 'isMilestone' || propertyName == 'assignmentsContent')) || propertyName == 'indentation'))
            refreshOtherViews();
        if (typeof originalItemPropertyChangeHandler !== 'undefined')
            originalItemPropertyChangeHandler(item, propertyName, isDirect, isFinal);
    }
    settings.displayedTimeChangeHandler = function (displayedTime) { refreshViewsDisplayedTime('GanttChart', displayedTime); };
    settings.splitterPositionChangeHandler = function (gridWidth, chartWidth) { refreshViewsSplitterPosition('GanttChart', gridWidth, chartWidth); };
    settings.hourWidthChangeHandler = function (hourWidth) { refreshOtherViews(); };
    var isWaitingToRefreshScheduleChartView, isWaitingToRefreshScheduleChartViewDisplayedTime, isWaitingToRefreshScheduleChartViewSplitterPosition,
        isWaitingToRefreshLoadChartView, isWaitingToRefreshLoadChartViewDisplayedTime, isWaitingToRefreshLoadChartViewSplitterPosition,
        isWaitingToRefreshGanttChartViewDisplayedTime, isWaitingToRefreshGanttChartViewSplitterPosition;
    function refreshOtherViews() {
        refreshScheduleChartView();
        refreshLoadChartResourceSelector();
        refreshLoadChartView();
        closePertChartView();
        closeNetworkDiagramView();
        closeLoadProjectXml();
        closeSaveProjectXml();
    }
    function refreshScheduleChartView() {
        if (scheduleChartPanel.style.display != 'none' && !isWaitingToRefreshScheduleChartView) {
            isWaitingToRefreshScheduleChartView = true;
            setTimeout(function () {
                isWaitingToRefreshScheduleChartView = false;
                var scheduleChartView = document.querySelector('#scheduleChartView');
                scheduleChartView.scheduleChartItems = ganttChartView.getScheduleChartItems();
                ganttChartView.copyCommonSettings(scheduleChartView.settings);
                scheduleChartView.refresh();
            });
        }
    }
    function refreshLoadChartResourceSelector() {
        var loadChartResourceFilter = document.querySelector('#loadChartResourceFilter'), i;
        for (i = loadChartResourceFilter.childNodes.length; i-- > 2;)
            loadChartResourceFilter.removeChild(loadChartResourceFilter.childNodes[i]);
        var resources = ganttChartView.getAssignedResources();
        for (i = 0; i < resources.length; i++) {
            var resource = resources[i];
            var option = document.createElement('option');
            option.appendChild(document.createTextNode(resource));
            loadChartResourceFilter.appendChild(option);
        }
    }
    function loadChartResourceFilterChanged() {
        refreshLoadChartView();
    }
    function refreshLoadChartView() {
        if (loadChartPanel.style.display != 'none' && !isWaitingToRefreshLoadChartView) {
            isWaitingToRefreshLoadChartView = true;
            setTimeout(function () {
                var loadChartView = document.querySelector('#loadChartView');
                var loadChartResourceFilter = document.querySelector('#loadChartResourceFilter');
                var resourceFilterValue = loadChartResourceFilter.value;
                if (resourceFilterValue == '') {
                    loadChartView.loadChartItems = ganttChartView.getLoadChartItems();
                    loadChartView.settings.itemHeight = 28;
                    loadChartView.settings.barHeight = 20;
                }
                else {
                    loadChartView.loadChartItems = ganttChartView.getLoadChartItems([resourceFilterValue]);
                    loadChartView.settings.itemHeight = 112;
                    loadChartView.settings.barHeight = 104;
                }
                ganttChartView.copyCommonSettings(loadChartView.settings);
                loadChartView.refresh();
                isWaitingToRefreshLoadChartView = false;
            });
        }
    }
    function refreshViewsDisplayedTime(sourceControlType, displayedTime) {
        if (sourceControlType != 'ScheduleChart' && scheduleChartPanel.style.display != 'none' && !isWaitingToRefreshScheduleChartViewDisplayedTime) {
            isWaitingToRefreshScheduleChartViewDisplayedTime = true;
            setTimeout(function () {
                var scheduleChartView = document.querySelector('#scheduleChartView');
                scheduleChartView.scrollToDateTime(displayedTime);
                isWaitingToRefreshScheduleChartViewDisplayedTime = false;
            });
        }
        if (sourceControlType != 'LoadChart' && loadChartPanel.style.display != 'none' && !isWaitingToRefreshLoadChartViewDisplayedTime) {
            isWaitingToRefreshLoadChartViewDisplayedTime = true;
            setTimeout(function () {
                var loadChartView = document.querySelector('#loadChartView');
                loadChartView.scrollToDateTime(displayedTime);
                isWaitingToRefreshLoadChartViewDisplayedTime = false;
            });
        }
        if (sourceControlType != 'GanttChart' && !isWaitingToRefreshGanttChartViewDisplayedTime) {
            isWaitingToRefreshGanttChartViewDisplayedTime = true;
            setTimeout(function () {
                ganttChartView.scrollToDateTime(displayedTime);
                isWaitingToRefreshGanttChartViewDisplayedTime = false;
            });
        }
    }
    function refreshViewsSplitterPosition(sourceControlType, gridWidth, chartWidth) {
        if (sourceControlType != 'ScheduleChart' && scheduleChartPanel.style.display != 'none' && !isWaitingToRefreshScheduleChartViewSplitterPosition) {
            isWaitingToRefreshScheduleChartViewSplitterPosition = true;
            setTimeout(function () {
                var scheduleChartView = document.querySelector('#scheduleChartView');
                scheduleChartView.setSplitterPosition(gridWidth, chartWidth);
                isWaitingToRefreshScheduleChartViewSplitterPosition = false;
            });
        }
        if (sourceControlType != 'LoadChart' && loadChartPanel.style.display != 'none' && !isWaitingToRefreshLoadChartViewSplitterPosition) {
            isWaitingToRefreshLoadChartViewSplitterPosition = true;
            setTimeout(function () {
                var loadChartView = document.querySelector('#loadChartView');
                loadChartView.setSplitterPosition(gridWidth, chartWidth);
                isWaitingToRefreshLoadChartViewSplitterPosition = false;
            });
        }
        if (sourceControlType != 'GanttChart' && !isWaitingToRefreshGanttChartViewSplitterPosition) {
            isWaitingToRefreshGanttChartViewSplitterPosition = true;
            setTimeout(function () {
                ganttChartView.setSplitterPosition(gridWidth, chartWidth);
                isWaitingToRefreshGanttChartViewSplitterPosition = false;
            });
        }
    }

    // Support for editing items.
    var GanttChartView = DlhSoft.Controls.GanttChartView;
    var DateTimePicker = DlhSoft.Controls.DateTimePicker;
    var MultiSelectorComboBox = DlhSoft.Controls.MultiSelectorComboBox;
    var editor = document.getElementById('editor');
    var editedItem;
    function editItem() {
        var item = ganttChartView.getSelectedItem();
        if (item == null)
            return;
        editedItem = item;
        var contentInput = document.getElementById('contentEditor');
        contentInput.value = item.content;
        var startInput = document.getElementById('startEditor');
        DateTimePicker.initialize(startInput, GanttChartView.getOutputDate(item.start), { defaultTimeOfDay: 8 * 60 * 60 * 1000, valueChangeHandler: onDateEditorChanged });
        startInput.removeAttribute('disabled');
        if (item.hasChildren)
            startInput.setAttribute('disabled', 'disabled');
        var finishInput = document.getElementById('finishEditor');
        finishInput.removeAttribute('disabled');
        if (item.hasChildren || item.isMilestone)
            finishInput.setAttribute('disabled', 'disabled');
        DateTimePicker.initialize(finishInput, !item.isMilestone ? GanttChartView.getOutputDate(item.finish) : null, { defaultTimeOfDay: 16 * 60 * 60 * 1000, valueChangeHandler: onDateEditorChanged });
        var effortInput = document.getElementById('effortEditor');
        effortInput.removeAttribute('disabled');
        if (item.hasChildren || item.isMilestone)
            effortInput.setAttribute('disabled', 'disabled');
        effortInput.value = (ganttChartView.getItemTotalEffort(item) / (60 * 60 * 1000)).toString();
        var durationInput = document.getElementById('durationEditor');
        durationInput.removeAttribute('disabled');
        if (item.hasChildren || item.isMilestone)
            durationInput.setAttribute('disabled', 'disabled');
        durationInput.value = (ganttChartView.getItemDuration(item) / (8 * 60 * 60 * 1000)).toString();
        var isMilestoneInput = document.getElementById('isMilestoneEditor');
        isMilestoneInput.removeAttribute('disabled');
        if (item.hasChildren)
            isMilestoneInput.setAttribute('disabled', 'disabled');
        isMilestoneInput.checked = item.isMilestone;
        var completionInput = document.getElementById('completionEditor');
        completionInput.removeAttribute('disabled');
        if (item.hasChildren || item.isMilestone)
            completionInput.setAttribute('disabled', 'disabled');
        completionInput.value = !item.isMilestone && item.finish > item.start ? Math.round(ganttChartView.getItemCompletion(item) * 100).toString() : '';
        var predecessorsInput = document.getElementById('predecessorsEditor');
        predecessorsInput.value = ganttChartView.getItemPredecessorsString(item);
        var assignmentsInput = document.getElementById('assignmentsEditor');
        MultiSelectorComboBox.initialize(assignmentsInput, ganttChartView.getAssignedResources(), item.assignmentsContent);
        var oldBaselineStartInput = document.getElementById('baselineStartEditor');
        var baselineStartInputParent = oldBaselineStartInput.parentElement;
        var baselineStartInput = document.createElement('input');
        baselineStartInput.setAttribute('id', 'baselineStartEditor');
        baselineStartInputParent.replaceChild(baselineStartInput, oldBaselineStartInput);
        var baselineStartDateTimePicker = DateTimePicker.initialize(baselineStartInput, null, { defaultTimeOfDay: 8 * 60 * 60 * 1000, isNullValueAccepted: true });
        if (item.baselineStart)
            baselineStartDateTimePicker.setValue(GanttChartView.getOutputDate(item.baselineStart));
        var oldBaselineFinishInput = document.getElementById('baselineFinishEditor');
        var baselineFinishInputParent = oldBaselineFinishInput.parentElement;
        var baselineFinishInput = document.createElement('input');
        baselineFinishInput.setAttribute('id', 'baselineFinishEditor');
        baselineFinishInputParent.replaceChild(baselineFinishInput, oldBaselineFinishInput);
        var baselineFinishDateTimePicker = DateTimePicker.initialize(baselineFinishInput, null, { defaultTimeOfDay: 16 * 60 * 60 * 1000, isNullValueAccepted: true });
        if (!item.isMilestone && item.baselineFinish)
            baselineFinishDateTimePicker.setValue(GanttChartView.getOutputDate(item.baselineFinish));
        baselineFinishInput.removeAttribute('disabled');
        if (item.isMilestone)
            baselineFinishInput.setAttribute('disabled', 'disabled');
        editor.style.display = 'block';
        settings.selectionMode = 'None';
    }
    function onDateEditorChanged() {
        var startInput = document.getElementById('startEditor');
        var finishInput = document.getElementById('finishEditor');
        var finishDateTimePicker = DateTimePicker.get(finishInput);
        var start = DateTimePicker.get(startInput).getValue();
        if (finishDateTimePicker.getValue() < start)
            setTimeout(function () { return finishDateTimePicker.setValue(start); });
        var effortInput = document.getElementById('effortEditor');
        var durationInput = document.getElementById('durationEditor');
        var isMilestoneInput = document.getElementById('isMilestoneEditor');
        effortInput.setAttribute('disabled', 'disabled');
        durationInput.setAttribute('disabled', 'disabled');
        isMilestoneInput.setAttribute('disabled', 'disabled');
    }
    function onEffortEditorChanged() {
        var startInput = document.getElementById('startEditor');
        var finishInput = document.getElementById('finishEditor');
        var durationInput = document.getElementById('durationEditor');
        var isMilestoneInput = document.getElementById('isMilestoneEditor');
        startInput.setAttribute('disabled', 'disabled');
        finishInput.setAttribute('disabled', 'disabled');
        durationInput.setAttribute('disabled', 'disabled');
        isMilestoneInput.setAttribute('disabled', 'disabled');
    }
    function onDurationEditorChanged() {
        var startInput = document.getElementById('startEditor');
        var finishInput = document.getElementById('finishEditor');
        var effortInput = document.getElementById('effortEditor');
        var isMilestoneInput = document.getElementById('isMilestoneEditor');
        startInput.setAttribute('disabled', 'disabled');
        finishInput.setAttribute('disabled', 'disabled');
        effortInput.setAttribute('disabled', 'disabled');
        isMilestoneInput.setAttribute('disabled', 'disabled');
    }
    function onIsMilestoneEditorChanged() {
        if (!editedItem)
            return;
        var isMilestoneInput = document.getElementById('isMilestoneEditor');
        var finishInput = document.getElementById('finishEditor');
        var effortInput = document.getElementById('effortEditor');
        var durationInput = document.getElementById('durationEditor');
        var completionInput = document.getElementById('completionEditor');
        var baselineFinishInput = document.getElementById('baselineFinishEditor');
        finishInput.removeAttribute('disabled');
        effortInput.removeAttribute('disabled');
        durationInput.removeAttribute('disabled');
        completionInput.removeAttribute('disabled');
        baselineFinishInput.removeAttribute('disabled');
        if (editedItem.hasChildren || isMilestoneInput.checked) {
            finishInput.setAttribute('disabled', 'disabled');
            effortInput.setAttribute('disabled', 'disabled');
            durationInput.setAttribute('disabled', 'disabled');
            completionInput.setAttribute('disabled', 'disabled');
        }
        if (isMilestoneInput.checked) {
            baselineFinishInput.setAttribute('disabled', 'disabled');
        }
    }
    function closeEditor() {
        // delete editedItem;
        editor.style.display = 'none';
        settings.selectionMode = 'Focus';
    }
    function saveEditor() {
        if (editedItem) {
            var contentInput = document.getElementById('contentEditor');
            ganttChartView.setItemContent(editedItem, contentInput.value);
            var assignmentsInput = document.getElementById('assignmentsEditor');
            ganttChartView.setItemAssignmentsContent(editedItem, assignmentsInput.value);
            if (!editedItem.hasChildren) {
                var isMilestoneInput = document.getElementById('isMilestoneEditor');
                ganttChartView.setItemIsMilestone(editedItem, isMilestoneInput.checked);
                var startInput = document.getElementById('startEditor');
                ganttChartView.setItemStart(editedItem, GanttChartView.getInputDate(DateTimePicker.get(startInput).getValue()));
                if (!editedItem.isMilestone) {
                    var finishInput = document.getElementById('finishEditor');
                    if (!finishInput.disabled) {
                        ganttChartView.setItemFinish(editedItem, GanttChartView.getInputDate(DateTimePicker.get(finishInput).getValue()));
                    }
                    else {
                        var effortInput = document.getElementById('effortEditor');
                        if (!effortInput.disabled) {
                            ganttChartView.setItemEffort(editedItem, parseFloat(effortInput.value) * 60 * 60 * 1000 / ganttChartView.getItemAllocationUnits(editedItem));
                        }
                        else {
                            var durationInput = document.getElementById('durationEditor');
                            if (!durationInput.disabled) {
                                ganttChartView.setItemDuration(editedItem, parseFloat(durationInput.value) * 8 * 60 * 60 * 1000);
                            }
                        }
                    }
                    var completionInput = document.getElementById('completionEditor');
                    ganttChartView.setItemCompletion(editedItem, completionInput.value ? parseFloat(completionInput.value) / 100 : 0);
                }
                else {
                    editedItem.finish = editedItem.start;
                }
            }
            var predecessorsInput = document.getElementById('predecessorsEditor');
            ganttChartView.setItemPredecessorsString(editedItem, predecessorsInput.value);
            var baselineStartInput = document.getElementById('baselineStartEditor');
            var baselineStart = DateTimePicker.get(baselineStartInput).getValue();
            if (baselineStart)
                editedItem.baselineStart = GanttChartView.getInputDate(baselineStart);
            else
                delete editedItem.baselineStart;
            var baselineFinishInput = document.getElementById('baselineFinishEditor');
            var baselineFinish = DateTimePicker.get(baselineFinishInput).getValue();
            if (baselineFinish)
                editedItem.baselineFinish = GanttChartView.getInputDate(baselineFinish);
            else
                delete editedItem.baselineFinish;
            ganttChartView.refreshItemNeighbourhood(editedItem);
        }
        closeEditor();
    }
}

const iniciarGanttDhtmlx = (ganttData) => {
    gantt.i18n.setLocale("es");
    gantt.plugins({
        tooltip: true,
        marker: true,
        fullscreen: true,
        export_api: true,
    });

    gantt.config.grid_width = 400;

    gantt.config.min_column_width = 50;
	gantt.config.scale_height = 90;

	var weekScaleTemplate = function (date) {
		var dateToStr = gantt.date.date_to_str("%d %M");
		var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
		return dateToStr(date) + " - " + dateToStr(endDate);
	};

	var daysStyle = function(date){
		// you can use gantt.isWorkTime(date)
		// when gantt.config.work_time config is enabled
		// In this sample it's not so we just check week days

		if(date.getDay() === 0 || date.getDay() === 6){
			return "weekend";
		}
		return "";
	};

    gantt.attachEvent("onTemplatesReady", function () {
        var toggle = document.createElement("i");
        toggle.className = "fa fa-expand gantt-fullscreen";
        gantt.toggleIcon = toggle;
        gantt.$container.appendChild(toggle);
        toggle.onclick = function() {
            gantt.ext.fullscreen.toggle();
        };
    });
    gantt.attachEvent("onExpand", function () {
        var icon = gantt.toggleIcon;
        if (icon) {
            icon.className = icon.className.replace("fa-expand", "fa-compress");
        }

    });
    gantt.attachEvent("onCollapse", function () {
        var icon = gantt.toggleIcon;
        if (icon) {
            icon.className = icon.className.replace("fa-compress", "fa-expand");
        }
    });

    var dateToStr = gantt.date.date_to_str(gantt.config.task_date);
    var today = new Date(2024, 8, 1);
    gantt.addMarker({
        start_date: today,
        css: "today",
        text: "Today",
        title: "Today: " + dateToStr(today)
    });

    var start = new Date(2024, 7, 28);
    gantt.addMarker({
        start_date: start,
        css: "status_line",
        text: "Start project",
        title: "Start project: " + dateToStr(start)
    });

    gantt.config.scale_height = 50;
    gantt.config.scales = [
		{unit: "month", step: 1, format: "%F, %Y"},
		{unit: "week", step: 1, format: weekScaleTemplate},
		{unit: "day", step:1, format: "%D", css:daysStyle }
	];
    gantt.attachEvent("onGanttReady", function(){
        var tooltips = gantt.ext.tooltips;
        tooltips.tooltip.setViewport(gantt.$task_data);
    });
    gantt.init("gantt_here");

    gantt.parse({
        data: ganttData
    });
}

$(document).on('click', '.btnExportarPDF', function(){
    // gantt.exportToPDF();
    gantt.exportToPDF({
        name: "Gantt.pdf"
    });
    // gantt.exportToPDF({
    //     name:"mygantt.pdf",
    //     header:"<h1>My company</h1>",
    //     footer:"<h4>Bottom line</h4>",
    //     locale:"en",
    //     start:"01-04-2013",
    //     end:"11-04-2013",
    //     skin:'terrace',
    //     data:{ },
    //     server:"https://myapp.com/myexport/gantt",
    //     raw:true,
    //     callback: function(res){
    //         alert(res.url);
    //     }
    // });
});

$(document).on('click', '.btnExportarPNG', function(){
    gantt.exportToPNG({ skin:"material" });
});