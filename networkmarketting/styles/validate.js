function IsValidPhone(thestring,nullflag)
{IsValid=true;if((nullflag=="notnull")&&(thestring==""||thestring=="undefined"))
{return false;}
stringcheck="0123456789- ";for(i=0;i<thestring.length;i++)
{namechar=thestring.charAt(i);for(j=0;j>stringcheck.length;j++)
{if(namechar==stringcheck.charAt(j))
{break;}
if(j==stringcheck.length-1)
{IsValid=false;}}}
return IsValid;}
function IsValidNumber(thestring,nullflag)
{IsValid=true;if((nullflag=="notnull")&&(thestring==""||thestring=="undefined"))
{return false;}
stringcheck="0123456789";for(i=0;i<thestring.length;i++)
{namechar=thestring.charAt(i);for(j=0;j<stringcheck.length;j++)
{if(namechar==stringcheck.charAt(j))
{break;}
if(j==stringcheck.length-1)
{IsValid=false;}}}
return IsValid;}
function IsValidAddress(thestring,nullflag)
{IsValid=true;if((nullflag=="notnull")&&(thestring==""||thestring=="undefined"||thestring=="null"))
{return false;}
return IsValid;}
function IsValidName(thestring,nullflag)
{IsValid=true;if((nullflag=="notnull")&&(thestring==""||thestring=="undefined"||thestring=="null"))
return false;stringcheck="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ- ";for(i=0;i<thestring.length;i++)
{namechar=thestring.charAt(i);for(j=0;j<stringcheck.length;j++)
{if(namechar==stringcheck.charAt(j))
break;if(j==stringcheck.length-1)
IsValid=false;}}
return IsValid;}
function IsAlpha(str)
{if((str.toLowerCase()>="a")&&(str.toLowerCase<="z"))
{return true;}
else return false;}
function IsAlphaNumeric(sString)
{var stringcheck="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-_";for(i=0;i<sString.length;i++)
{namechar=sString.charAt(i);for(j=0;j<stringcheck.length;j++)
{if(namechar==stringcheck.charAt(j))
break;if(j==stringcheck.length-1)
return false;}}
return true;}
function IsValidGA(sString)
{var stringcheck="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-";for(i=0;i<sString.length;i++)
{namechar=sString.charAt(i);for(j=0;j<stringcheck.length;j++)
{if(namechar==stringcheck.charAt(j))
break;if(j==stringcheck.length-1)
return false;}}
return true;}
function IsVaildIP(sValue)
{var re=new RegExp("^\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}$");if(!re.test(sValue))
return false;return true;}
function ShowAlert(cControl,sMessage)
{alert(sMessage);cControl.select();cControl.focus();}
function ShowAlert1(cControl)
{cControl.select();cControl.focus();}
function IsCapital(sValue)
{var re=new RegExp("^[A-Z\\s]*$");if(!re.test(sValue))
return false;return true;}
function IsInteger(sValue)
{var re=new RegExp("^\\d*$");if(!re.test(sValue))
return false;return true;}
function IsNumeric(sValue)
{var re=new RegExp("^\\d*(\\.\\d+)?$");if(!re.test(sValue))
return false;return true;}
function IsRealNumber(sValue)
{var re=new RegExp("^\\-?\\d*(\\.\\d+)?$");if(!re.test(sValue))
return false;return true;}
function IsContact(sValue)
{var re=new RegExp("^\\d+$");if(!re.test(sValue))
return false;return true;}
function IsEmail(sValue)
{var re=new RegExp("^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$");if(!re.test(sValue))
return false;return true;}
function IsStandardGA(sValue)
{var re=new RegExp("^[A-Za-z]{3,}([\\-]?[A-Za-z0-9]+)*$");if(!re.test(sValue))
return false;return true;}
function IsValidName(sValue)
{var re=new RegExp("^[a-zA-Z\\s\\-\\.]*[a-zA-Z]+[a-zA-Z\\s\\-\\.]*$");if(!re.test(sValue))
return false;return true;}
function IsCurrency(sValue)
{var re=new RegExp("^[\\d,]*\\.?\\d*$");if(!re.test(sValue))
return false;return true;}
function IsCreditCardNo(txt)
{var ccLen=txt.length;if(ccLen!=16)
return false;return true;}
function IsString(sValue)
{var re=new RegExp("^[a-zA-Z\\s]*$");if(!re.test(sValue))
return false;return true;}
function IsBlank(s)
{var len=s.length
var i
for(i=0;i<len;++i)
{if(s.charAt(i)!=" ")return false}
return true}
var dtCh="/";function isInteger(s){var i;for(i=0;i<s.length;i++){var c=s.charAt(i);if(((c<"0")||(c>"9")))return false;}
return true;}
function stripCharsInBag(s,bag){var i;var returnString="";for(i=0;i<s.length;i++){var c=s.charAt(i);if(bag.indexOf(c)==-1)returnString+=c;}
return returnString;}
function daysInFebruary(year){return(((year%4==0)&&((!(year%100==0))||(year%400==0)))?29:28);}
function DaysArray(n){for(var i=1;i<=n;i++){this[i]=31
if(i==4||i==6||i==9||i==11){this[i]=30}
if(i==2){this[i]=29}}
return this}
function IsDate(dtStr,sMessage){var daysInMonth=DaysArray(12)
var pos1=dtStr.indexOf(dtCh)
var pos2=dtStr.indexOf(dtCh,pos1+1)
var strDay=dtStr.substring(0,pos1)
var strMonth=dtStr.substring(pos1+1,pos2)
var strYear=dtStr.substring(pos2+1)
strYr=strYear
if(strDay.charAt(0)=="0"&&strDay.length>1)strDay=strDay.substring(1)
if(strMonth.charAt(0)=="0"&&strMonth.length>1)strMonth=strMonth.substring(1)
for(var i=1;i<=3;i++){if(strYr.charAt(0)=="0"&&strYr.length>1)strYr=strYr.substring(1)}
month=parseInt(strMonth)
day=parseInt(strDay)
year=parseInt(strYr)
if(pos1==-1||pos2==-1){alert(sMessage+" (format must be : d/m/yyyy)")
return false}
if(strMonth.length<1||month<1||month>12){alert("ERROR: Invalid month. "+sMessage)
return false}
if(strDay.length<1||day<1||day>31||(month==2&&day>daysInFebruary(year))||day>daysInMonth[month]){alert("ERROR: Invalid day. "+sMessage)
return false}
if(strYear.length!=4||year==0){alert(sMessage+" Enter a valid 4 digit year.")
return false}
if(dtStr.indexOf(dtCh,pos2+1)!=-1||isInteger(stripCharsInBag(dtStr,dtCh))==false){alert(" ERROR : Invalid date. "+sMessage)
return false}
return true}
function fIsDate(dtStr,objInput,sInputName){var daysInMonth=DaysArray(12)
var pos1=dtStr.indexOf(dtCh)
var pos2=dtStr.indexOf(dtCh,pos1+1)
var strDay=dtStr.substring(0,pos1)
var strMonth=dtStr.substring(pos1+1,pos2)
var strYear=dtStr.substring(pos2+1)
if(!IsInteger(strDay)||!IsInteger(strMonth)||!IsInteger(strYear)||strYear.length!=4){alert("ERROR: Invalid "+sInputName+" (format must be : d/m/yyyy)")
objInput.focus();objInput.select(dtStr.length);return false}
strYr=strYear
if(strDay.charAt(0)=="0"&&strDay.length>1)strDay=strDay.substring(1)
if(strMonth.charAt(0)=="0"&&strMonth.length>1)strMonth=strMonth.substring(1)
for(var i=1;i<=3;i++){if(strYr.charAt(0)=="0"&&strYr.length>1)strYr=strYr.substring(1)}
month=parseInt(strMonth)
day=parseInt(strDay)
year=parseInt(strYr)
if(pos1==-1||pos2==-1){alert("ERROR: Invalid "+sInputName+" (format must be : d/m/yyyy)")
objInput.focus();objInput.select(dtStr.length);return false}
if(strMonth.length<1||month<1||month>12){alert("ERROR: Invalid month in "+sInputName+" field.")
objInput.focus();objInput.select(dtStr.length);return false}
if(strDay.length<1||day<1||day>31||(month==2&&day>daysInFebruary(year))||day>daysInMonth[month]){alert("ERROR: Invalid day in "+sInputName+" field.")
objInput.focus();objInput.select(dtStr.length);return false}
if(strYear.length!=4||year==0){alert(sMessage+" Enter a valid 4 digit year in "+sInputName+" field.")
objInput.focus();objInput.select(dtStr.length);return false}
if(dtStr.indexOf(dtCh,pos2+1)!=-1||isInteger(stripCharsInBag(dtStr,dtCh))==false){alert(" ERROR : Invalid date in "+sInputName+" field.")
objInput.focus();objInput.select(dtStr.length);return false}
return true}
var CurrentControl
function ShowCal(Control,FormID)
{CurrentControl=Control
open('../lib/Cal2.asp?FormID='+FormID,'Calendar','menubar=no, width=180, height=220, resizable=no')}
function ShowDate(FormID)
{CurrentControl.value=document.forms[eval(FormID)].HiddenDate.value}
function ExtraAuth(sTarget,sTitle)
{self.location.href='sec_q.asp?TPage='+sTarget+'&Title='+sTitle;}
function ExtraAuth_QS(sTarget,sTitle,sQueryString)
{self.location.href='sec_q.asp?TPage='+sTarget+'&Title='+sTitle+'&QS='+sQueryString;}
function Go2Profile(sTarget)
{alert("Sorry. You can not use this page unless you enter mother's name in your personal profile.");self.location.href='personal_profile.asp?TPage='+sTarget;}
function doIt(chk,chkall)
{if(chk.length>0)
{for(var i=0;i<chk.length;i++)
if(chk[i].disabled==false)
chk[i].checked=chkall.checked;}
else
if(chk.disabled==false)
chk.checked=chkall.checked;}
function ApplyAll(frm,chkall)
{if(frm.chkvalues.length>0)
{for(var i=0;i<frm.chkvalues.length;i++)
{if(frm.elements['chk||'+frm.chkvalues[i].value].checked!=chkall.checked)frm.chkvalues[i].checked=1;frm.elements['chk||'+frm.chkvalues[i].value].checked=chkall.checked;}}
else
{if(frm.elements['chk||'+frm.chkvalues.value].checked!=chkall.checked)frm.chkvalues.checked=1;frm.elements['chk||'+frm.chkvalues.value].checked=chkall.checked;}}
function SelectRecord(frm,txt)
{if(frm.chkvalues.length>0)
{for(var i=0;i<frm.chkvalues.length;i++)
if(frm.chkvalues[i].value==txt)
{frm.chkvalues[i].checked=1;break;}}
else
frm.chkvalues.checked=1;}
function isDelete(chk)
{if(isAnyChecked(chk))
{if(confirm('This will delete all selected record(s). Proceed?'))
return true;else
return false;}
else
{alert('No record is selected for delete')
return false}}
function isMarkUnread(chk)
{if(isAnyChecked(chk))
{if(confirm('This will mark all selected messages as unread. Proceed?'))
return true;else
return false;}
else
{alert('No record is selected for mark')
return false}}
function isMark(chk,sMark)
{if(isAnyChecked(chk))
{if(confirm('This will mark all selected messages as '+sMark+'. Proceed?'))
return true;else
return false;}
else
{alert('No record is selected for mark')
return false}}
function isNavigate(chk)
{if(isAnyChecked(chk))
{if(confirm('This will loss any unsaved information of this page. Proceed?'))return true;return false;}
return true;}
function isAnyChecked(chk)
{if(chk.length>0)
{for(var i=0;i<chk.length;i++)
if(chk[i].checked)break;if(i==chk.length)return false;else return true;}
else
if(chk.checked)return true;else return false;}
function fCheckForSameLetter(sUserInput,iMinimumLength)
{var A,B,sInput,bReturnedValue;bReturnedValue=false;sInput=new String(sUserInput);if(sInput.length<iMinimumLength)
{return bReturnedValue;}
A=sInput.charAt(0);for(i=1;i<sInput.length;i++)
{B=sInput.charAt(i);if(B!=A)
bReturnedValue=true;}
return bReturnedValue;}
function IsValidPinCode(txtInputValue){var re=new RegExp("(\\d)\\1\\1|^\\d{0,3}$");return(!re.test(txtInputValue))}
function fReCalUSDAmount(txtSenderAmount,hUSDRate,txtUSDAmount)
{var jdUSDRate,jcSenderAmount,jfSenderAmount
jdUSDRate=parseFloat(hUSDRate);jcSenderAmount=parseFloat(txtSenderAmount.value)/jdUSDRate;jfSenderAmount=Math.floor(jcSenderAmount);jcSenderAmount=((jcSenderAmount-jfSenderAmount)>=0.75&&jcSenderAmount>10?jfSenderAmount+1:jfSenderAmount);txtUSDAmount.value=(IsNumeric(jcSenderAmount)?parseFloat(jcSenderAmount):0);}
addEvent(window,"load",alternate_init);function alternate_init(){if(!document.getElementsByTagName)return;tbls=document.getElementsByTagName("table");for(ti=0;ti<tbls.length;ti++){thisTbl=tbls[ti];if(((' '+thisTbl.className+' ').indexOf("alternate_rows")!=-1)&&(thisTbl.id)){alternate(thisTbl);}}}
function addEvent(elm,evType,fn,useCapture)
{if(elm.addEventListener){elm.addEventListener(evType,fn,useCapture);return true;}else if(elm.attachEvent){var r=elm.attachEvent("on"+evType,fn);return r;}else{alert("Handler could not be removed");}}
function replace(s,t,u){i=s.indexOf(t);r="";if(i==-1)return s;r+=s.substring(0,i)+u;if(i+t.length<s.length)
r+=replace(s.substring(i+t.length,s.length),t,u);return r;}
function alternate(table){var tableBodies=table.getElementsByTagName("tbody");for(var i=0;i<tableBodies.length;i++){var tableRows=tableBodies[i].getElementsByTagName("tr");for(var j=0;j<tableRows.length;j++){if((j%2)==0){if(tableRows[j].className=='odd'||!(tableRows[j].className.indexOf('odd')==-1)){tableRows[j].className=replace(tableRows[j].className,'odd','even');}else{tableRows[j].className+=" even";}}else{if(tableRows[j].className=='even'||!(tableRows[j].className.indexOf('even')==-1)){tableRows[j].className=replace(tableRows[j].className,'even','odd');}
tableRows[j].className+=" odd";}}}}