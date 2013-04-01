var height_avant=200;
var height_avant_final=500;

function edit_zform_height(c,b,f,e){
	var g=document.getElementById(c);
	var d=document.getElementById(b);
	var a=document.getElementById(f);
	height_avant=height_avant+Number(e);
	if(height_avant<200){
		height_avant=200;
	}
	if(height_avant>2000){
		height_avant=2000;
	}
	height_avant_final=height_avant_final+Number(e);
	if(height_avant_final<200){
		height_avant_final=200;
	}
	if(height_avant_final>2000){
		height_avant_final=2000;
	}
	change=height_avant+"px";
	change_final=height_avant_final+"px";
	g.style.height=change;
	d.style.height=change;
	a.style.maxHeight=change_final;
	return false;
}

function ouvrir_page(c,b,a,d){
	window.open(c,b,"toolbar=yes,personalbar=yes,titlebar=yes,location=yes,directories=yes,width="+a+",height="+d+",scrollbars=yes,resizable=yes")
}

function remplace(e,c,b){
	var a=e;
	var d=c.length;
	while(a.indexOf(c)>-1){
		pos=a.indexOf(c);
		a=(a.substring(0,pos)+b+a.substring((pos+d),a.length));
	}
	return a;
}

function trim(a){
	return a.replace(/^\s\s*/,"").replace(/\s\s*$/,"");
}
			
function balise(c,f,e){
	var h=document.getElementById(e);
	var b=h.scrollTop;
	c=remplace(c,"<br />","\n");
	if(f==""){
		c=" "+c+" ";
	}
	if(h.curseur){
		h.curseur.text=c+h.curseur.text+f					
	}
	else{
		if(h.selectionStart>=0&&h.selectionEnd>=0){
			if(h.selectionStart==h.selectionEnd&&empty(trim(h.value.substring(h.selectionEnd,h.value.length)))){
				h.setSelectionRange(h.value.length,h.value.length);
			}
			var a=h.value.substring(0,h.selectionStart);
			var d=h.value.substring(h.selectionStart,h.selectionEnd);
			var g=h.value.substring(h.selectionEnd);
			h.value=a+c+d+f+g;h.focus();
			h.setSelectionRange(a.length+c.length,h.value.length-g.length-f.length);
		}
		else{
			h.value+=c+f;
			h.focus();
		}
	}
	h.scrollTop=b;
}

function add_bal2(a,d,c,b){
	var f=document.getElementById(c);
	var e="";
	if(a=="lien"){
		if(f.curseur){
			txt_selectionne=f.curseur.text;
		}
		else{
			if(f.selectionStart>=0&&f.selectionEnd>=0){
				txt_selectionne=f.value.substring(f.selectionStart,f.selectionEnd);
			}
			else{
				txt_selectionne="";
			}
		}
		if(txt_selectionne.indexOf("http://")==0||txt_selectionne.indexOf("https://")==0||txt_selectionne.indexOf("ftp://")==0||txt_selectionne.indexOf("apt://")==0){
			e="Veuillez indiquer le texte du lien";
			bal2=prompt(e);
			balise_debut="<"+a+" "+d+'="';
			balise_fin='">'+bal2+"</"+a+">";
		}
		else{
			if(txt_selectionne==""){
				e="Veuillez indiquer le lien";
				bal=prompt(e);
				bal2=prompt("Veuillez indiquer le texte du lien");
				balise_debut="<"+a+" "+d+'="'+bal+'">'+bal2;balise_fin="</"+a+">";
			}
			else{
				e="Veuillez indiquer le lien";
				bal=prompt(e);
				balise_debut="<"+a+" "+d+'="'+bal+'">';
				balise_fin="</"+a+">";
			}
		}
	}
	else{
		if(a=="email"){
			e="Veuillez indiquer l'email";
			bal=prompt(e);
			balise_debut="<"+a+" "+d+'="'+bal+'">';balise_fin="</"+a+">";
		}
	}
	balise(balise_debut,balise_fin,c);
	if(document.getElementById(a)){
		document.getElementById(a).options[0].selected=true;
	}
}

function add_bal3(b,e,d,c,a){
	if(b=="code"&&$("#coche_minicode:checked").val()!=undefined){
		b="minicode";
	}
	if(a==null){
		balise_debut="<"+b+">";
		balise_fin="</"+b+">";
	}
	else{
		balise_debut="<"+b+" "+c+'="'+a+'">';
		balise_fin="</"+b+">";
	}
	balise(balise_debut,balise_fin,e);
	if(document.getElementById(b)){
		document.getElementById(b).options[0].selected=true;
	}
}

function add_liste(d,g){
	var n="";
	var f=document.getElementById(d);
	var h="";
	var l="";
	var b="";
	if(f.selectionStart>=0&&f.selectionEnd>=0){
		if(f.selectionStart==f.selectionEnd&&empty(trim(f.value.substring(f.selectionEnd,f.value.length)))){
			f.setSelectionRange(f.value.length,f.value.length);
		}
		var e=f.value.substring(0,f.selectionStart);
		var k=f.value.substring(f.selectionStart,f.selectionEnd);
		var m=f.value.substring(f.selectionEnd);
		k=trim(k);
		h=k.split("\n");
		if(h[0]==null||h[0]==""){
			l+="\t<puce></puce>\n";
			l+="\t<puce></puce>\n";
			l+="\t<puce></puce>\n"
		}
		else{
			for(var a=0,j=h.length;a<j;a++){
			if(h[a]==null||h[a]==""){
					h[a]="-";
				}
				l+="\t<puce>"+h[a]+"</puce>\n";
			}
		}
		f.value="";
		n=l;
		balise(e+"<liste>\n"+n,"</liste>"+m,d);
	}
	else{
		if(f.curseur){
			b=trim(f.curseur.text);
			h=b.split("\n");
			if(h[0]==null||h[0]==""){
				l+="\t<puce></puce>\n";
				l+="\t<puce></puce>\n";
				l+="\t<puce></puce>\n";
			}
			else{
				Aremplacer=new RegExp("(\r\n|\r|\n)","g");
				for(var a=0,j=h.length;a<j;a++){
					if(h[a]==null||h[a]==""){
						h[a]="-";
					}
					l+="\t<puce>"+h[a].replace(Aremplacer,"")+"</puce>\n";
				}
			}
			n=l;
			f.curseur.text="";
			balise("<liste>\n"+n,"</liste>",d);
		}
	}
}
			
function add_table(d,c){
	var g=document.getElementById("row_nbr").value;
	var f=document.getElementById("column_nbr").value;
	var a=document.getElementById("table_header").checked;
	var b="";
	var h,e;
	if(f>20){
		f=20;
	}
	if(g>99){
		g=99;
	}
	if(a){
		b+="\t<ligne>\n";
		for(h=0;h<f;h++){
			b+="\t\t<entete></entete>\n";
		}
		b+="\t</ligne>\n";
	}
	for(e=0;e<g;e++){
		b+="\t<ligne>\n";
		for(h=0;h<f;h++){
			b+="\t\t<cellule></cellule>\n";
		}
		b+="\t</ligne>\n";
	}
	balise("<tableau>\n"+b,"</tableau>",d);
}			
			
$(document).ready(function(){$(".zform_trigger").click(function(){if($(this).next().css("display")=="none"){$(".zform_menu").hide();$(this).next().show()}else{$(this).next().hide()}});$(".bouton_cliquable").click(function(){$(".zform_menu").hide()});$(".zform").click(function(){$(".zform_menu").hide()});$(".bouton_code").click(function(){if(!language_exists(recent_zcode,$(this).html())){insert_new_element(recent_zcode,$(this).html());insert_new_element(recent_zcode_attr,$(this).attr("onclick"));display_recent(recent_zcode,recent_zcode_attr)}});$("div[id^='recent_']").click(function(){var a=$(this).html();$("#liste_code").each(function(b){if($(this).text()==a){$(this).click()}$(".zform_menu").hide()})})});
$(".zform").each(function(){zform_names_of_text[zform_names_of_text.length]=$(this).children().attr("id")});
