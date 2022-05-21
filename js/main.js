import { alertMultipleMail, alertSendMail, alertModifyAlu, alertDelete, alertCreate, alertMultipleModify, alertMultipleDelete, alertModifyProf, alertChangePasswordProf, alertUploadCSV, alertDownloadCSV } from './alerts.js'
import { asyncShow, asyncShowClases, asyncShowDepts } from './ajax.js'
import { changeUsername, changeDataVisualizationScope, removeLimit, changeLimit, checkCheckedCheckboxes, checkAllCheckboxes, storeLocalFilter, voidLocalFilter, changePage, displayLocalFilter, changeOrderBy, updatePageButtons } from './utils.js'


window.asyncShow = asyncShow;
window.asyncShowClases = asyncShowClases;
window.alertModifyAlu = alertModifyAlu;
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
window.alertChangePasswordProf = alertChangePasswordProf;
window.alertUploadCSV = alertUploadCSV;
window.alertDownloadCSV = alertDownloadCSV;
window.alertSendMail = alertSendMail;
window.alertMultipleMail = alertMultipleMail;


window.onload = () => {
    changeUsername()
    asyncShow()
    displayLocalFilter()
    let scope = localStorage.getItem('data_scope');
    if (!scope || scope == 'alumnos') {
        asyncShowClases('filtro-select')
    } else {
        asyncShowDepts('filtro-select')
    }

}