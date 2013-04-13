var ieDOM = false, nsDOM = false;
var stdDOM = document.getElementById; function initMethod()
{
//Determine the browser support for the DOM
if( !stdDOM )

{
ieDOM = document.all;

if( !ieDOM )

{
nsDOM = ((navigator.appName.indexOf('Netscape') != -1) && (parseInt(navigator.appVersion) ==4));
}
}

passwordChanged();
}

function getObject(objectId)

{
if (stdDOM) return document.getElementById(objectId);
if (ieDOM) return document.all[objectId];
if (nsDOM) return document.layers[objectId];
}

function getObjectStyle(objectId)

{
if (nsDOM) return getObject(objectId);

var obj = getObject(objectId);

return obj.style;
}

function showDefault(objectId)

{
showCell(objectId, "#E2E2E2", "#E2E2E2");
}

function showCell(objectId, foreColor, backColor)
{
getObjectStyle(objectId).color = foreColor;

getObjectStyle(objectId).backgroundColor = backColor;
}

function showWeak()

{
showCell("pwWeak", "Black", "#FF6666");

showDefault("pwMedium");

showDefault("pwStrong");
}

function showMedium()

{
showCell("pwWeak", "#FFCC66", "#FFCC66");
showCell("pwMedium", "Black", "#FFCC66");

showDefault("pwStrong");
}

function showStrong()

{
showCell("pwWeak", "#80FF80", "#80FF80");
showCell("pwMedium", "#80FF80", "#80FF80");
showCell("pwStrong", "Black", "#80FF80");
}

function showUndetermined()

{
showDefault("pwWeak");
showDefault("pwMedium");
showDefault("pwStrong");
}


function passwordChanged()
{
var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
var enoughRegex = new RegExp("(?=.{6,}).*", "g");

//var pwd = document.getElementById("password");
var pwd = getObject("user_password").value;
if( false == enoughRegex.test(pwd) )
{
showUndetermined();
}
else if( strongRegex.test(pwd) )
{
showStrong();
}
else if( mediumRegex.test( pwd ) )
{
showMedium();
}
else
{
showWeak();
}
}