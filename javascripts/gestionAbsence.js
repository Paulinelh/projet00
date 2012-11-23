absent = 'absent=';
present = 'present=';
/**
 * Gère les absents en ajoutant l'id de l'élève absent à une variable (var absent). 
 * Change l'opacité à 50. 
 * Bloque bouton absent et debloque bouton present.
 * @param : ID de l'étudiant absent
 */
function Absent(id){
	//Bloquer le bouton absent et remmetre le bouton present pour eviter des conflits.
	$("#"+id+" .absent").attr("disabled",true);
	$("#"+id+" .present").attr("disabled",false);

	//Gestion opacité de la photo : 50
	idOpacity = "img" + id;
	changeOpac(50,idOpacity);

        //Enlever les présent qui sont finalement absent.
        var regPres=new RegExp(id + ',', "g");
	present = present.replace(regPres,"");
        
	//Ajout de l'absent
	absent = absent + id +",";
}

/**
 * Gère les présent. Supprimes s'ils avaient été déclaré absent les élèves finalement présent 
 * Change l'opacité à 100. 
 * Bloque bouton present et debloque bouton absent .
 * @param : ID de l'étudiant present
 */
function Present(id){
	//Bloquer le bouton present et remmetre le bouton absent pour eviter des conflits.
	$("#"+id+" .absent").attr("disabled",false);
	$("#"+id+" .present").attr("disabled",true);
	
	//Enlever les absents qui sont enfaite présent.
	var reg=new RegExp(id + ',', "g");
	absent = absent.replace(reg,"");
	
	//Gestion opacité photo : 100
	idOpacity = "img" + id;
	changeOpac(100,idOpacity);	
        
        present = present + id +",";
}

/**
 * Si il y a des absent envoie au script declareAbsence.php les id des personnes absentes. Sinon envoie simplement au script sans les id.
 */
function Valider(){
    
    /*if(absent == "id="){
            window.location.assign("scriptPhp/declarerAbsence.php");	
    }else{*/
            absent = absent.substring(0,absent.length-1);
            present = present.substring(0,present.length-1);
            var adresse = "scriptPhp/declarerAbsence.php?"+absent+"&"+present;
            window.location.assign(adresse);
    //}
}

/**
 * Gère l'opacité d'un élément en fonction de son id et de l'opacité voulu.
 * Compatible tous navigateur.
 * @param opacity : Opacité désiré
 * @param : id de l'élément à griser.
 */
function changeOpac(opacity, id) { 
	var object = document.getElementById(id).style; 
	object.opacity = Math.sin(opacity / 100); 
	object.MozOpacity = Math.sin(opacity / 100); 
	object.KhtmlOpacity = Math.sin(opacity / 100); 
	object.filter = "alpha(opacity=" + opacity + ")"; 
} 