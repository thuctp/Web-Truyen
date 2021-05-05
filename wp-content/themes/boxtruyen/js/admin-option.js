function panel(id){
	document.getElementsByClassName('panel-actived')[0].classList.remove('panel-actived');
	document.getElementsByClassName('panel-'+id)[0].classList.add('panel-actived');
	
	document.getElementsByClassName('a-panel-actived')[0].classList.remove('a-panel-actived');
	document.getElementsByClassName('a-panel-'+id)[0].classList.add('a-panel-actived');
}