/***********************************************************
Ladezeit-Skript
************************************************************/

ladestart = new Date();

function ladezeit() {

current = new Date();
dtime = current.getTime() - ladestart.getTime();
loadtime = dtime/1000;
document.getElementById("Ladezeit").innerHTML = loadtime;
document.getElementById("loadtime").value = loadtime;
}
