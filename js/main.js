import { alertModify, alertDelete, alertCreate, alertMultipleModify, alertMultipleDelete, alertModifyProf } from './alerts.js'
import { asyncShow, asyncShowClases } from './ajax.js'
import { changeDataVisualizationScope, removeLimit, changeLimit, checkCheckedCheckboxes, checkAllCheckboxes, storeLocalFilter, voidLocalFilter, changePage, displayLocalFilter, changeOrderBy } from './utils.js'


window.asyncShow = asyncShow;
window.asyncShowClases = asyncShowClases;
window.alertModify = alertModify;
window.alertDelete = alertDelete;
window.alertCreate = alertCreate;
window.alertMultipleModify = alertMultipleModify;
window.alertMultipleDelete = alertMultipleDelete;
window.checkCheckedCheckboxes = checkCheckedCheckboxes;
window.checkAllCheckboxes = checkAllCheckboxes;
window.storeLocalFilter = storeLocalFilter;
window.voidLocalFilter = voidLocalFilter;
window.changePage = changePage;
window.changeOrderBy = changeOrderBy;
window.removeLimit = removeLimit;
window.changeLimit = changeLimit;
window.changeDataVisualizationScope = changeDataVisualizationScope;
window.alertModifyProf = alertModifyProf;


window.onload = () => {
    asyncShow()
    displayLocalFilter()
}