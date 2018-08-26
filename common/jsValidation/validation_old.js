// Form Guard

// Copyright Xin Yang 2003
// Web Site: www.yxScripts.com
// EMail: m_yangxin@hotmail.com

// This script is free as long as the copyright notice remains intact.

var reInt=/^\d+$/;
var reSignedInt=/^(\+|-)?\d+$/;
var reFloat=/^\d+(\.\d+)?$/;
var reSignedFloat=/^(\+|-)?\d+(\.\d+)?$/;
var reChar=/^[\w\-]+$/;
var reEMail=/^\w[\w\-\.]+\@\w[\w\-]+(\.[\w\-]+)+$/;
var reIP=/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;
var rePostalCA=/^(\w\d){3}$/;

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


function _checkIt(re, field, msg) {
  if (field.value=="")
  	return true;
  if (!re.test(field.value)) {
    alert(msg);

    field.select();
    field.focus();

    return false;
  }

  return true;
}

function goodPhone(pf, field, msg) {
  return _checkIt(rePhone(pf), field, msg);
}

// returns true if str is alphabetic or number
// that is only A-Z a-z not space
// returns false otherwise
// returns false if empty
function goodFileName(field, msg)
{
	var str = field.value;
	var len= str.length;
	if (len==0)
	{
		alert(msg);
		field.select();
		field.focus();
		return false;
	}
	//else
	var p=0;
	var ok= true;
	var ch= "";
	while (ok && p<len)
	{
		ch= str.charAt(p);
		if (  ('A'<=ch && ch<='Z')
			||('a'<=ch && ch<='z')
			||('0'<=ch && ch<='9')
			|| ch=='-' || ch=='_')
		{
		  p++;
		 }
		else
		{
			alert(msg);
			field.select();
			field.focus();
			return false;
		 }
	}
	return true;
}

function goodPostalCA(field, msg) {
  return _checkIt(rePostalCA, field, msg);
}

function goodDate(df, field, msg) {
  if (_checkIt(reDate(df), field, msg)) {
    var di=field.value;
    var y4=df.search(/yyyy/i), y=di.substring(y4, y4+4)-0;
    var m2=df.search(/mm/i), m=di.substring(m2, m2+2)-1;
    var d2=df.search(/dd/i), d=di.substring(d2, d2+2)-0;

    var dd=new Date(y, m, d);
    if (y==dd.getFullYear() && m==dd.getMonth() && d==dd.getDate()) {
      return true;
    }
    else {
      alert(msg);

      field.select();
      field.focus();
    }
  }

  return false;
}

function goodIP(field, msg) {
  return _checkIt(reIP, field, msg);
}

function goodChar(field, msg) {
  return _checkIt(reChar, field, msg);
}

function goodEMail(field, msg) {
  return _checkIt(reEMail, field, msg);
}

function goodInt(field, msg) {
  return _checkIt(reInt, field, msg);
}

function goodSignedInt(field, msg) {
  return _checkIt(reSignedInt, field, msg);
}

function goodFloat(field, msg) {
  return _checkIt(reFloat, field, msg);
}

function goodSignedFloat(field, msg) {
  return _checkIt(reSignedFloat, field, msg);
}

function goodIntLen(n, field, msg) {
  return _checkIt(reNumberN(n,0), field, msg);
}

function goodSignedIntLen(n, field, msg) {
  return _checkIt(reNumberN(n,1), field, msg);
}

function goodIntLen2(n, field, msg) {
  return _checkIt(reNumberN2(n,0), field, msg);
}

function goodSignedIntLen2(n, field, msg) {
  return _checkIt(reNumberN2(n,1), field, msg);
}

function goodCharLen(n, m, field, msg) {
  return _checkIt(reCharNM(n,m), field, msg);
}

function goodFloatLen(n, m, field, msg) {
  return _checkIt(reNumberNM(n,m,0), field, msg);
}

function goodSignedFloatLen(n, m, field, msg) {
  return _checkIt(reNumberNM(n,m,1), field, msg);
}

function goodFloatLen2(n, m, field, msg) {
  return _checkIt(reNumberNM2(n,m,0), field, msg);
}

function goodSignedFloatLen2(n, m, field, msg) {
  return _checkIt(reNumberNM2(n,m,1), field, msg);
}

function _rangeIt(field, r1, r2, msg) {
  if (field.value>=r1 && field.value<=r2) {
    return true;
  }
  else {
    alert(msg);

    field.select();
    field.focus();

    return false;
  }
}

function rangeInt(field, r1, r2, msg) {
  if (goodInt(field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeSignedInt(field, r1, r2, msg) {
  if (goodSignedInt(field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeFloat(field, r1, r2, msg) {
  if (goodFloat(field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeSignedFloat(field, r1, r2, msg) {
  if (goodSignedFloat(field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeIntLen(n, field, r1, r2, msg) {
  if (goodIntLen(n, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeSignedIntLen(n, field, r1, r2, msg) {
  if (goodSignedIntLen(n, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeIntLen2(n, field, r1, r2, msg) {
  if (goodIntLen2(n, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeSignedIntLen2(n, field, r1, r2, msg) {
  if (goodSignedIntLen2(n, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeFloatLen(n, m, field, r1, r2, msg) {
  if (goodFloatLen(n, m, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeSignedFloatLen(n, m, field, r1, r2, msg) {
  if (goodSignedFloatLen(n, m, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeFloatLen2(n, m, field, r1, r2, msg) {
  if (goodFloatLen2(n, m, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function rangeSignedFloatLen2(n, m, field, r1, r2, msg) {
  if (goodSignedFloatLen2(n, m, field, msg)) {
    return _rangeIt(field, r1, r2, msg);
  }

  return false;
}

function _dd(n) {
  return (n<10)?"0"+n:""+n;
}

function _getOffset(n) {
  var d=new Date();
  if (n!=0) {
    d.setTime(d.getTime()+n*86400000);
  }
  return d.getFullYear()+""+_dd(d.getMonth()+1)+""+_dd(d.getDate())+"";
}

function _stringIt(df, d) {
  var y4=df.search(/yyyy/i), m2=df.search(/mm/i), d2=df.search(/dd/i);
  return d.substring(y4, y4+4)+d.substring(m2, m2+2)+d.substring(d2, d2+2);
}

function rangeDate(df, field, r1, r2, msg) {
  if (goodDate(df, field, msg)) {
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
      alert(msg);

      field.select();
      field.focus();
    }
    else {
      return true;
    }
  }

  return false;
}

function goodDateRange(df, field1, field2, msg) {
  if (goodDate(df, field1, msg) && goodDate(df, field2, msg)) {
    if (_stringIt(df, field1.value)>_stringIt(df, field2.value)) {
      alert(msg);
      field1.focus();
    }
    else {
      return true;
    }
  }

  return false;
}

function goodDateRange2(df, field1, field2, msg) {
  if (goodDate(df, field1, msg) && goodDate(df, field2, msg)) {
    if (_stringIt(df, field1.value)>=_stringIt(df, field2.value)) {
      alert(msg);
      field1.focus();
    }
    else {
      return true;
    }
  }

  return false;
}
