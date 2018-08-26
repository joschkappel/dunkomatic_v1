// Form Guard

// Copyright Xin Yang 2003, 2004
// Web Site: www.yxScripts.com
// EMail: m_yangxin@hotmail.com
// Last Updated: Sep-01-2004

// This script is free as long as the copyright notice remains intact.

// to consolidate all error messages
var totalAlert="";

// form submit counter
var submitCounter=0;

// regular expressions used by checking functions
var reNonBlank=/[\S]/;
var reHexColor=/^#[0-9a-fA-F]{6}$/;
var reInt=/^\d+$/;
var reSignedInt=/^(\+|-)?\d+$/;
var reFloat=/^\d+(\.\d+)?$/;
var reSignedFloat=/^(\+|-)?\d+(\.\d+)?$/;
var reChar=/^[\w\-]+$/;
var reEMail=/^\w[\w\-\.]+\@\w[\w\-]+(\.\w[\w\-]+)+$/;
var reIP=/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;
var rePostalCA=/^(\w\d){3}$/;
var reURL=/^http(s)?\:\/\/\w[\w\-]+(\.\w[\w\-]+)+([\/\%\?\&\+\#\.\w\-]+)*$/;

function rpChar(f) {
  var df=f;

  df=df.replace(/\\/g, '\\\\');
  df=df.replace(/\//g, '\\\/');
  df=df.replace(/\[/g, '\\\[');
  df=df.replace(/\]/g, '\\\]');
  df=df.replace(/\(/g, '\\\(');
  df=df.replace(/\)/g, '\\\)');
  df=df.replace(/\{/g, '\\\{');
  df=df.replace(/\}/g, '\\\}');
  df=df.replace(/\</g, '\\\<');
  df=df.replace(/\>/g, '\\\>');
  df=df.replace(/\|/g, '\\\|');
  df=df.replace(/\*/g, '\\\*');
  df=df.replace(/\?/g, '\\\?');
  df=df.replace(/\+/g, '\\\+');
  df=df.replace(/\^/g, '\\\^');
  df=df.replace(/\$/g, '\\\$');

  return df;
}

function rePhone(f) {
  var df=rpChar(f);

  df=df.replace(/d/gi, '\\d');
  df=df.replace(/w/gi, '(\\w|\\d)');

  return new RegExp('^'+df+'$');
}

function reDate(f) {
  var df=rpChar(f);

  df=df.replace(/dd/gi, '\\d\\d');
  df=df.replace(/mm/gi, '\\d\\d');
  df=df.replace(/yyyy/gi, '\\d\\d\\d\\d');

  return new RegExp('^'+df+'$');
}

function reCharNM(n,m) {
  return new RegExp("\^[\\w\\-]{"+n+","+m+"}\$");
}

function reNumberN(n,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{1,"+n+"}\$");
}

function reNumberN2(n,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{"+n+"}\$");
}

function reNumberNM(n,m,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{1,"+n+"}(\\.\\d{1,"+m+"})?\$");
}

function reNumberNM2(n,m,mode) {
  return new RegExp("\^"+(mode!=0?"(\\+\|-)?":"")+"\\d{"+n+"}\\.\\d{"+m+"}\$");
}

// wrapper functions
function _alertIt(msg, mode) {
  if (mode) {
    totalAlert+=msg+"\n";
  }
  else {
    totalAlert="";
    alert(msg);
  }
}

function _checkIt(re, field, msg, mode) {
  if (!re.test(field.value)) {
    _alertIt(msg, mode);

    if (field.select) {
      field.select();
    }
    if (field.focus) {
      field.focus();
    }

    return (mode && mode==1)?true:false;
  }

  return true;
}

function noErrors() {
  if (totalAlert=="") {
    return true;
  }
  else {
    alert(totalAlert);
    totalAlert="";
    return false;
  }
}

// the checking functions


function goodDate(df, field, msg, mode) {
  if (_checkIt(reDate(df), field, msg, mode?2:0)) {
    var di=field.value;
    var y4=df.search(/yyyy/i), y=di.substring(y4, y4+4)-0;
    var m2=df.search(/mm/i), m=di.substring(m2, m2+2)-1;
    var d2=df.search(/dd/i), d=di.substring(d2, d2+2)-0;

    var dd=new Date(y, m, d);
    if (y==dd.getFullYear() && m==dd.getMonth() && d==dd.getDate()) {
      return true;
    }
    else {
      _alertIt(msg, mode);

      field.select();
      field.focus();
    }
  }

  return (mode && mode==1)?true:false;
}

function goodGameTime(field, msg, mode) {

      var gt = field.value;
	 
	  if (gt == '') {
		  return true;
	  }

      if (gt.length < 5) {
         gt = "0"+gt;
         }
      
      var hrs = gt.substring(0,2);
      var min = gt.substring(3,5);

      var ihrs = parseInt( hrs, 10 );
   
      if ( isNaN(ihrs) ) {
        _alertIt ('Uhrzeit darf nur Ziffern und : enthalten',mode);
         field.select();
     	  field.focus();
        return false;
        }

      if ( !((min == '00') || (min == '15') || (min == '30') || (min == '45'))){
		  _alertIt ('Spiele nur auf volle Viertelstunden ansetzen (:00, :15, :30 und :45)',mode);
	      field.select();
    	  field.focus();
    	  return false;
    	  }

      if ( ihrs < 9 ) {
 		  _alertIt ('Spiele nur nach 9 Uhr ansetzen',mode);
	      field.select();
    	  field.focus();
    	  return false;
    	  }

      if ( ihrs >= 23){
 		  _alertIt ('Spiele nur vor 23 Uhr ansetzen',mode);
	      field.select();
    	  field.focus();
    	  return false;
    	  }


return true;
}

function rangeDate(df, field, r1, r2, msg, mode) {
  if (goodDate(df, field, msg, mode?2:0)) {
    var d=_stringIt(df, field.value);

    var r1x="", r2x="";
    if (r1.search(/^\d+$/)!=-1) {
      r1x=_getOffset(r1-0);
    }
    else {
      r1x=_stringIt(df, r1);
    }
    if (r2.search(/^\d+$/)!=-1) {
      r2x=_getOffset(r2-0);
    }
    else {
      r2x=_stringIt(df, r2);
    }

    if (d<r1x || d>r2x) {
      _alertIt(msg, mode);

      field.select();
      field.focus();
    }
    else {
      return true;
    }
  }

  return (mode && mode==1)?true:false;
}

function goodDateRange(df, field1, field2, msg, mode) {
  if (goodDate(df, field1, msg, mode?2:0) && goodDate(df, field2, msg, mode?2:0)) {
    if (_stringIt(df, field1.value)>_stringIt(df, field2.value)) {
      _alertIt(msg, mode);
      field1.focus();
    }
    else {
      return true;
    }
  }

  return (mode && mode==1)?true:false;
}

function goodDateRange2(df, field1, field2, msg, mode) {
  if (goodDate(df, field1, msg, mode?2:0) && goodDate(df, field2, msg, mode?2:0)) {
    if (_stringIt(df, field1.value)>=_stringIt(df, field2.value)) {
      _alertIt(msg, mode);
      field1.focus();
    }
    else {
      return true;
    }
  }

  return (mode && mode==1)?true:false;
}

