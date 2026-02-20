import 'jquery-validation/dist/localization/messages_es.js';
import "jquery.quicksearch";
import { driver } from "driver.js";
import "driver.js/dist/driver.css";

window.driver = driver;
window.intlTelInput = require("intl-tel-input");

require('./generalidades');
require('./datatables.init');
require('./bootstrap');
require("fslightbox");
