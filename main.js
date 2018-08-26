//--------------------cookie functions-------------------------
function getCookie(NameOfCookie){
    if (document.cookie.length > 0) { 
		//alert(document.cookie);
    begin = document.cookie.indexOf(NameOfCookie+"=");       
    if (begin != -1) {           
      begin += NameOfCookie.length+1;       
      end = document.cookie.indexOf(";", begin);
      if (end == -1) end = document.cookie.length;
        return unescape(document.cookie.substring(begin, end));
    } 
  }
  return null;
}

function setCookie(NameOfCookie, value, expiredays)
{
	var ExpireDate = new Date ();
	ExpireDate.setTime(ExpireDate.getTime() + (expiredays * 24 * 3600 * 1000));
	
	var theCookie = NameOfCookie + "=" + escape(value)+";";
	theCookie= theCookie + ((expiredays == null) ? "" : " expires=" + ExpireDate.toGMTString());
	theCookie = theCookie + " path=/";
	document.cookie = theCookie;
}

function delCookie (NameOfCookie) 
{
  if (getCookie(NameOfCookie)) 
  {
	var now = new Date();
	var yesterday = new Date(now.getTime() - 1000 * 60 * 60 * 24);
	setCookie(NameOfCookie, '', yesterday);
  
  }
}
//--------------------cookie functions-------------------------

//------------browser type-----------
isIE=document.all;
isNN=!document.all&&document.getElementById;
//------------browser type-----------

//------------------------click position-----------
function findPosX(obj)
{
	var mX = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			mX += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		mX += obj.x;
	return mX;
}

function findPosY(obj)
{
	var mY = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			mY += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		mY += obj.y;
	return mY;
}
//------------------------click position-----------

//---------------layer show hide-----------
function hideLayer(objName)
{
	popObj=get_object(objName)
	 
	if ((isIE||isNN) && popObj) 
	{
		popObj.style.visibility="hidden";
	}
}

function showLayer(clickedObj,objName,offsetX,offsetY)
{
	mX=findPosX(clickedObj);
	mY=findPosY(clickedObj);
	popObj=get_object(objName)
	if ((isIE||isNN) && popObj) 
	{
		xpos=mX+offsetX;
		ypos=mY+offsetY;
		popObj.style.left=xpos + "px";
		popObj.style.top= ypos+ "px";
		popObj.style.visibility="visible";
	}
}
//---------------layer show hide-----------

//--------------object getting - cross browser------------
function get_object(objName)
{
	if (isIE)
	{
		evalText="document.all."+objName;
		Obj=eval(evalText);
	}
	else
	{
		Obj=document.getElementById(objName);
	}
	return Obj;
}

function get_hidden_obj(objName,form_name)
{
	if (isIE)
	{
		evalText="document.all."+objName;
		Obj=eval(evalText);
	}
	else
	{
		evalText="document."+form_name+"."+objName;
		Obj=eval(evalText);
	}
	return Obj;
}
//--------------object getting - cross browser------------

//----------------checkbox array checks-------------------
//check if an array of checboxes that was declered with [] has any records selected.
function is_checkbox_arr_selecetd(obj_name,form_name)
{
	var checkboxArrObj = eval('document.'+form_name+'["'+obj_name+'"]');
	if (checkboxArrObj==null)
	{
		return false;
	}
	if (checkboxArrObj.checked)
	{
		return true;
	}
	for (i=0; i<checkboxArrObj.length;i++)
	{
		if (checkboxArrObj[i].checked)
		{
			return true;
		}
	}
	return false;
}
function isArray(obj)
{
	return(typeof(obj.length)=="undefined")?false:true;
}

function select_all_checkboxes(obj_name,form_name,value)
{
	var checkboxArrObj = eval('document.'+form_name+'["'+obj_name+'"]');
	if (checkboxArrObj==null)
	{
		return;
	}
	if (!isArray(checkboxArrObj))
	{
		checkboxArrObj.checked=value;
	}
	else
	{
		for (i=0; i<checkboxArrObj.length;i++)
		{
			checkboxArrObj[i].checked=value;
		}
	}
}
//----------------checkbox array checks-------------------

function select_object(obj_id,form_name,hiddenName)
{
	var hiddenObj = eval('document.'+form_name+'.'+hiddenName);
	hiddenObj.value=obj_id;
}


/**
 * (JK) This array is used to remember mark status of rows in browse mode
 */
var marked_row = new Array;




//---(JK)-----set pointer------------------------
/**
 * Sets/unsets the pointer and marker in browse mode
 *
 * @param   object    the table row
 * @param   integer  the row number
 * @param   string    the action calling this script (over, out or click)
 * @param   string    the default background color
 * @param   string    the color to use for mouseover
 * @param   string    the color to use for marking a row
 *
 * @return  boolean  whether pointer is set or not
 */
function setPointer(theRow, theRowNum, theAction, theDefaultColor, thePointerColor, theMarkColor)
{
    var theCells = null;

    // 1. Pointer and mark feature are disabled or the browser can't get the
    //    row -> exits
    if ((thePointerColor == '' && theMarkColor == '')
        || typeof(theRow.style) == 'undefined') {
        return false;
    }

    // 2. Gets the current row and exits if the browser can't get it
    if (typeof(document.getElementsByTagName) != 'undefined') {
        theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        theCells = theRow.cells;
    }
    else {
        return false;
    }

    // 3. Gets the current color...
    var rowCellsCnt  = theCells.length;
    var domDetect    = null;
    var currentColor = null;
    var newColor     = null;
    // 3.1 ... with DOM compatible browsers except Opera that does not return
    //         valid values with "getAttribute"
    if (typeof(window.opera) == 'undefined'
        && typeof(theCells[0].getAttribute) != 'undefined') {
        currentColor = theCells[0].getAttribute('bgcolor');
        domDetect    = true;
    }
    // 3.2 ... with other browsers
    else {
        currentColor = theCells[0].style.backgroundColor;
        domDetect    = false;
    } // end 3

    // 3.3 ... Opera changes colors set via HTML to rgb(r,g,b) format so fix it
    if (currentColor.indexOf("rgb") >= 0)
    {
        var rgbStr = currentColor.slice(currentColor.indexOf('(') + 1,
                                     currentColor.indexOf(')'));
        var rgbValues = rgbStr.split(",");
        currentColor = "#";
        var hexChars = "0123456789ABCDEF";
        for (var i = 0; i < 3; i++)
        {
            var v = rgbValues[i].valueOf();
            currentColor += hexChars.charAt(v/16) + hexChars.charAt(v%16);
        }
    }

    // 4. Defines the new color
    // 4.1 Current color is the default one
    if (currentColor == ''
        || currentColor.toLowerCase() == theDefaultColor.toLowerCase()) {
        if (theAction == 'over' && thePointerColor != '') {
            newColor              = thePointerColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor              = theMarkColor;
            marked_row[theRowNum] = true;
            // Garvin: deactivated onclick marking of the checkbox because it's also executed
            // when an action (like edit/delete) on a single item is performed. Then the checkbox
            // would get deactived, even though we need it activated. Maybe there is a way
            // to detect if the row was clicked, and not an item therein...
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = true;
        }
    }
    // 4.1.2 Current color is the pointer one
    else if (currentColor.toLowerCase() == thePointerColor.toLowerCase()
             && (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])) {
        if (theAction == 'out') {
            newColor              = theDefaultColor;
        }
        else if (theAction == 'click' && theMarkColor != '') {
            newColor              = theMarkColor;
            marked_row[theRowNum] = true;
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = true;
        }
    }
    // 4.1.3 Current color is the marker one
    else if (currentColor.toLowerCase() == theMarkColor.toLowerCase()) {
        if (theAction == 'click') {
            newColor              = (thePointerColor != '')
                                  ? thePointerColor
                                  : theDefaultColor;
            marked_row[theRowNum] = (typeof(marked_row[theRowNum]) == 'undefined' || !marked_row[theRowNum])
                                  ? true
                                  : null;
            // document.getElementById('id_rows_to_delete' + theRowNum).checked = false;
        }
    } // end 4

    // 5. Sets the new color...
    if (newColor) {
        var c = null;
        // 5.1 ... with DOM compatible browsers except Opera
        if (domDetect) {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].setAttribute('bgcolor', newColor, 0);
            } // end for
        }
        // 5.2 ... with other browsers
        else {
            for (c = 0; c < rowCellsCnt; c++) {
                theCells[c].style.backgroundColor = newColor;
            }
        }
    } // end 5

    return true;
} // end of the 'setPointer()' function

