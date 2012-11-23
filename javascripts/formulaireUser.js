var compteur = 1;
function fAddText() {
	if(compteur <= 15){			
		var Contenu = document.getElementById('cible').innerHTML;
		Contenu = Contenu + '<input type=\"text\" name=\"matiere'+compteur+'\"/>';
		document.getElementById('cible').innerHTML = Contenu;

		var label = document.getElementById('labelmatiere').innerHTML;
		label = label + '<label class="right inline">Matiere '+compteur+' :</label>';
		document.getElementById('labelmatiere').innerHTML = label;

		compteur++;
	}else{
		document.getElementById('messageErreur').style.display='block';
		document.getElementById('boutonAdd').style.display='none';
	}
}