{{-- <div class="ribbonContainer">
    <div class="ribbonPanel">
        <div class="ribbonHeader">Cronograma</div>
        <div class="ribbonCommandsArea">
            <div class="ribbonCommand">
                <a href="javascript:setCustomScales();" title="Establecer escalas personalizadas">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/CustomScales.png') }}" alt="Balanzas personalizadas"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:zoomIn();" title="Acercarse">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/ZoomIn.png') }}" alt="Acercarse"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:decreaseTimelinePage();" title="Avanzar hacia el pasado">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/DecreaseTimelinePage.png') }}" alt="Disminuir página de línea de tiempo"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:increaseTimelinePage();" title="Avanzar hacia el futuro">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/IncreaseTimelinePage.png') }}" alt="Aumentar la página de la línea de tiempo"/>
                </a>
            </div>
        </div>
    </div>
    <div class="ribbonPanel">
        <div class="ribbonHeader">Otras vistas</div>
        <div class="ribbonCommandsArea">
            <div class="ribbonCommand">
                <a href="javascript:scheduleChart();" title="Cuadro de horarios">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/ScheduleChart.png') }}" alt="Cuadro de horarios"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:loadChart();" title="Tabla de carga">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/LoadChart.png') }}" alt="Tabla de carga"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:pertChart();" title="Gráfico PERT">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/PertChart.png') }}" alt="Gráfico PERT"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:networkDiagram();" title="Diagrama de Red">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/NetworkDiagram.png') }}" alt="Diagrama de Red"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:projectStatistics();" title="Estadísticas del proyecto">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/ProjectStatistics.png') }}" alt="Estadísticas del proyecto"/>
                </a>
            </div>
        </div>
    </div>
    <div class="ribbonPanel">
        <div class="ribbonHeader">XML e impresión</div>
        <div class="ribbonCommandsArea">
            <div class="ribbonCommand">
                <a href="javascript:loadProjectXml();" title="Importar contenido XML del proyecto">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/LoadProjectXml.png') }}" alt="Importar proyecto XML"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:saveProjectXml();" title="Exportar contenido XML del proyecto">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/SaveProjectXml.png') }}" alt="Exportar Proyecto XML"/>
                </a>
            </div>
            <div class="ribbonCommand">
                <a href="javascript:print();" title="Imprimir">
                    <img src="{{ asset('assets/gantt-dlhsoft/Images/Print.png') }}" alt="Imprimir"/>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Support for editing items (element hidden by default from CSS). -->
<div id="editor" class="editor">
    <p class="header">Edit task</p>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>Task</td>
            <td class="cell"><input id="contentEditor" /></td>
            <td class="last-column-header">Est.</td>
        </tr>
        <tr>
            <td>Start</td>
            <td class="cell"><input id="startEditor" /></td>
            <td class="cell"><input id="baselineStartEditor" /></td>
        </tr>
        <tr>
            <td>Finish</td>
            <td class="cell"><input id="finishEditor" /></td>
            <td class="cell"><input id="baselineFinishEditor" /></td>
        </tr>
        <tr>
            <td>Effort (h)</td>
            <td class="cell"><input id="effortEditor" onchange="onEffortEditorChanged()" /></td>
        </tr>
        <tr>
            <td>Duration (d)</td>
            <td class="cell"><input id="durationEditor" onchange="onDurationEditorChanged()" /></td>
        </tr>
        <tr>
            <td>Milestone</td>
            <td class="cell"><input id="isMilestoneEditor" type="checkbox"
                    onchange="onIsMilestoneEditorChanged()" /></td>
        </tr>
        <tr>
            <td>Completed %</td>
            <td class="cell"><input id="completionEditor" /></td>
        </tr>
        <tr>
            <td>Predecessors</td>
            <td class="cell"><input id="predecessorsEditor" /></td>
        </tr>
        <tr>
            <td>Assignments</td>
            <td class="cell"><input id="assignmentsEditor" /></td>
        </tr>
    </table>
    <div class="command-area">
        <a class="command main" href="javascript://" onclick="saveEditor()">Save</a>
        <a class="command" href="javascript://" onclick="closeEditor()">Cancel</a>
    </div>
</div>
<!-- Component and other areas and views. -->
<div id="ganttChartView" style="height: 388px">...</div>
<div id="loadProjectXmlPanel" style="display: none">
    <div class="extraPanel">
        <div class="extraPanelCommandsArea">
            <div><a href="javascript:closeLoadProjectXml();">Close</a></div>
        </div>
        <div class="extraPanelHeader">Import Project XML</div>
        <div class="extraPanelContent" style="margin: 4px 0px 4px 0px">
            Enter/paste Project XML content to load:
            <div style="margin: 4px 0px 4px 0px">
                <textarea id="loadProjectXmlInput" spellcheck="false" cols="120" rows="4">&lt;Project/&gt;</textarea>
            </div>
            <a id="loadProjectXmlButton" href="javascript:loadProjectXmlContent();"
                title="Load Project XML content">Load</a>
        </div>
    </div>
</div>
<div id="saveProjectXmlPanel" style="display: none">
    <div class="extraPanel">
        <div class="extraPanelCommandsArea">
            <div><a href="javascript:closeSaveProjectXml();">Close</a></div>
        </div>
        <div class="extraPanelHeader">Export Project XML</div>
        <div class="extraPanelContent" style="margin: 4px 0px 4px 0px">
            View/copy Project XML content:
            <div style="margin: 4px 0px 4px 0px">
                <textarea id="saveProjectXmlOutput" readonly="readonly" cols="120" rows="4"></textarea>
            </div>
        </div>
    </div>
</div>
<div id="scheduleChartPanel" style="display: none">
    <div class="extraPanel">
        <div class="extraPanelCommandsArea">
            <div><a href="javascript:closeScheduleChartView();">Close</a></div>
        </div>
        <div class="extraPanelHeader">Schedule Chart</div>
    </div>
    <div id="scheduleChartView" style="height: 190px">...</div>
</div>
<div id="loadChartPanel" style="display: none">
    <div class="extraPanel">
        <div class="extraPanelCommandsArea">
            <div><a href="javascript:closeLoadChartView();">Close</a></div>
        </div>
        <div class="extraPanelHeader">Load Chart</div>
        <div class="extraPanelContent">
            Resource filter:
            <select id="loadChartResourceFilter" style="margin: 2px 0px" onchange="loadChartResourceFilterChanged()">
                <option value="">(All)</option>
            </select>
        </div>
    </div>
    <div id="loadChartView" style="height: 190px">...</div>
</div>
<div id="pertChartPanel" style="display: none">
    <div class="extraPanel">
        <div class="extraPanelCommandsArea">
            <div><a href="javascript:closePertChartView();">Close</a></div>
        </div>
        <div class="extraPanelHeader">PERT Chart</div>
    </div>
    <div id="pertChartView" style="height: 190px">...</div>
</div>
<div id="networkDiagramPanel" style="display: none">
    <div class="extraPanel">
        <div class="extraPanelCommandsArea">
            <div><a href="javascript:closeNetworkDiagramView();">Close</a></div>
        </div>
        <div class="extraPanelHeader">Network Diagram</div>
    </div>
    <div id="networkDiagramView" style="height: 190px">...</div>
</div>
<br>
<hr> --}}

<div class="gantt_control mb-4">
	<input value="Exportar PDF" class="btn btn-eliminar btnExportarPDF" disabled type="button">
	<input value="Exportar PNG" class="btn btn-primary-gijac btnExportarPNG" disabled type="button">
</div>

<div id="gantt_here" style='width:100%; height:100%;'></div>