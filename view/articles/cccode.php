<div class="boutons_zform">
	<div class="boutons">
		<img src="<?php echo IMG.DS.'CCCode'.DS.'gras.png'; ?>" alt="Gras" title="Gras" class="bouton_cliquable" onclick="balise(&#39;&lt;gras&gt;&#39;,&#39;&lt;/gras&gt;&#39;, &#39;texte&#39;); return false;" />
		<img src="images/boutons/italic.png" alt="Italique" title="Italique" class="bouton_cliquable" onclick="balise(&#39;&lt;italique&gt;&#39;,&#39;&lt;/italique&gt;&#39;, &#39;texte&#39;); return false;" />
		<img src="images/boutons/souligne.png" alt="Souligne" title="Souligné" class="bouton_cliquable" onclick="balise(&#39;&lt;souligne&gt;&#39;,&#39;&lt;/souligne&gt;&#39;, &#39;texte&#39;); return false;" />
		<img src="images/boutons/barre.png" alt="Barre" title="Barré" class="bouton_cliquable" onclick="balise(&#39;&lt;barre&gt;&#39;,&#39;&lt;/barre&gt;&#39;, &#39;texte&#39;); return false;" />
	</div>
	
	<div class="boutons">
		<img src="images/boutons/exposant.png" alt="Exposant" title="Exposant" class="bouton_cliquable" onclick="balise(&#39;&lt;exposant&gt;&#39;,&#39;&lt;/exposant&gt;&#39;, &#39;texte&#39;); return false;" />
		<img src="images/boutons/indice.png" alt="Indice" title="Indice" class="bouton_cliquable" onclick="balise(&#39;&lt;indice&gt;&#39;,&#39;&lt;/indice&gt;&#39;, &#39;texte&#39;); return false;" />
	</div>
	
	<div class="boutons">
		<div style="float:left;">
			<img src="images/boutons/couleurs.png" alt="Couleurs" title="Couleurs" class="zform_trigger" />
			<div class="zform_menu" style="display: none; ">
				<table>
					<tr>
						<td class="bg_rouge zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;rouge&#39;); return false;"></td>
						<td class="bg_orange zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;orange&#39;); return false;"></td>
						<td class="bg_jaune zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;jaune&#39;); return false;"></td>
					</tr>
					<tr>
						<td class="bg_vertc zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;vertc&#39;); return false;"></td>
						<td class="bg_vertf zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;vertf&#39;); return false;"></td>
						<td class="bg_bleu zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;bleu&#39;); return false;"></td>
					</tr>
					<tr>
						<td class="bg_marron zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;marron&#39;); return false;"></td>
						<td class="bg_noir zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;noir&#39;); return false;"></td>
						<td class="bg_gris zform_couleur bouton_cliquable" onclick="add_bal3(&#39;couleur&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;nom&#39;,&#39;gris&#39;); return false;"></td>
					</tr>
				</table>
			</div>
		</div>
		<div style="float:left;">
			<img src="images/boutons/taille.png" alt="Taille" title="Taille" class="zform_trigger" />
			<div class="zform_menu" style="display: none; ">
				<div class="ttpetit bouton_cliquable element" onclick="add_bal3(&#39;taille&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;ttpetit&#39;); return false;">Très très petit</div>
						<div class="tpetit bouton_cliquable element" onclick="add_bal3(&#39;taille&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;tpetit&#39;); return false;">Très petit</div>
						<div class="petit bouton_cliquable element" onclick="add_bal3(&#39;taille&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;petit&#39;); return false;">Petit</div>
						<div class="gros bouton_cliquable element" onclick="add_bal3(&#39;taille&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;gros&#39;); return false;">Gros</div>
						<div class="tgros bouton_cliquable element" onclick="add_bal3(&#39;taille&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;tgros&#39;); return false;">Très gros</div>
						<div class="ttgros bouton_cliquable element" onclick="add_bal3(&#39;taille&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;ttgros&#39;); return false;">Très très gros</div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	
	
	<!--Positionnement-->
	<div class="boutons">
		<img src="images/boutons/centre.png" alt="Centre" title="Au centre" class="bouton_cliquable" onclick="add_bal3(&#39;position&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;centre&#39;); return false;" />
		<img src="images/boutons/droite.png" alt="Droite" title="Aligné à droite" class="bouton_cliquable" onclick="add_bal3(&#39;position&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;droite&#39;); return false;" />
	</div>
	
	<div class="boutons">
		<img src="images/boutons/flottant_gauche.png" alt="Floattant à gauche" title="Floattant à gauche" class="bouton_cliquable" onclick="add_bal3(&#39;flottant&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;gauche&#39;); return false;" />
		<img src="images/boutons/flottant_droite.png" alt="Floattant à droite" title="Floattant à droite" class="bouton_cliquable" onclick="add_bal3(&#39;flottant&#39;,&#39;texte&#39;,&#39;prev_texte&#39;,&#39;valeur&#39;,&#39;droite&#39;); return false;" />
	</div>
	
	<div class="boutons">
		<img src="images/boutons/lien.png" alt="Lien" title="Lien" class="bouton_cliquable" onclick="add_bal2(&#39;lien&#39;,&#39;url&#39;,&#39;texte&#39;,&#39;prev_texte&#39;); return false;" />
		<img src="images/boutons/email.png" alt="Email" title="Lien e-mail" class="bouton_cliquable" onclick="add_bal2(&#39;email&#39;,&#39;nom&#39;,&#39;texte&#39;,&#39;prev_texte&#39;); return false;" />
	</div>
	
	<div class="boutons">
		<img src="images/boutons/image.png" alt="Image" title="Image" class="bouton_cliquable" onclick="balise(&#39;&lt;image&gt;&#39;,&#39;&lt;/image&gt;&#39;, &#39;texte&#39;); return false;" />
		<a href="uploadImg.php?dir=artricles" onclick="ouvrir_page(this.href,&#39;uploads&#39;,700,500); return false;">
			<img src="images/boutons/up_image.png" alt="Image" title="Envoyer une image" class="bouton_cliquable"  />
		</a>
	</div>
	
	<div class="boutons">
		<div style="float:left;">
		<img src="images/boutons/liste.png" alt="Liste" title="Liste à puces" class="bouton_cliquable" onclick="add_liste(&#39;texte&#39;,&#39;prev_texte&#39;); return false;"/>
		</div>
		
		<div style="float:left;">
			<img src="images/boutons/tableau.png" alt="Tableau" title="Tableau" class="zform_trigger ">
			<div class="zform_menu" style="display: none; ">
				<label for="table_header" class="label_cote">En-tête</label><input type="checkbox" name="table_header" id="table_header" checked="checked"><br />
				<label for="row_nbr" class="label_cote">Nombre de lignes</label><input type="text" name="row_nbr" id="row_nbr" style="width:30px;" maxlength="2" autocomplete="off"><br />
				<label for="column_nbr" class="label_cote">Nombre de colonnes</label><input type="text" name="column_nbr" id="column_nbr" style="width:30px;" maxlength="2" autocomplete="off"><br />
				<input type="button" value="Valider" name="tab_submit_button" id="tab_submit_button" onclick="add_table(&#39;texte&#39;,&#39;prev_texte&#39;);" class="bouton_cliquable" style="float:right;">
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	
	<div class="boutons">
		<img src="images/boutons/citer.png" alt="Citer" title="Citer" class="bouton_cliquable" onclick="balise(&#39;&lt;citation&gt;&#39;,&#39;&lt;/citation&gt;&#39;, &#39;texte&#39;); return false;"/>
		<img src="images/boutons/secret.png" alt="Secret" title="Secret" class="bouton_cliquable" onclick="balise(&#39;&lt;secret&gt;&#39;,&#39;&lt;/secret&gt;&#39;, &#39;texte&#39;);return false;"/>
	</div>
		
	<div class="boutons">
		<div style="float:left;">
			<img src="images/boutons/specials.png" alt="Spécials" title="Spécials" class="zform_trigger" />
			<div class="zform_menu" style="display: none; ">
				<img src="images/boutons/miniinfo.png" alt="Info" title="Information" border="none" id="info" name="info" class="bouton_cliquable element" onclick="balise(&#39;&lt;information&gt;&#39;,&#39;&lt;/information&gt;&#39;, &#39;texte&#39;); return false;" />
				<img src="images/boutons/miniattention.png" alt="Attention" title="Attention" class="bouton_cliquable element" onclick="balise(&#39;&lt;attention&gt;&#39;,&#39;&lt;/attention&gt;&#39;, &#39;texte&#39;); return false;" />
				<img src="images/boutons/minierreur.png" alt="Erreur" title="Erreur" class="bouton_cliquable element" onclick="balise(&#39;&lt;erreur&gt;&#39;,&#39;&lt;/erreur&gt;&#39;, &#39;texte&#39;); return false;" />
				<img src="images/boutons/miniquestion.png" alt="Question" title="Question"  class="bouton_cliquable element" onclick="balise(&#39;&lt;question&gt;&#39;,&#39;&lt;/question&gt;&#39;, &#39;texte&#39;);   return false;" />
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	
	<div class="boutons">
		<img src="images/boutons/texte_plus.png" id="zform_height_plus_texte" value="+" onclick="edit_zform_height(&#39;texte&#39;, &#39;prev_texte&#39;, &#39;prev_final_texte&#39;, 50); return false;" title="Agrandir la zone de saisie" />
		<img src="images/boutons/texte_moins.png" name="zform_height_moins" id="zform_height_moins_texte" value="-" onclick="edit_zform_height(&#39;texte&#39;, &#39;prev_texte&#39;, &#39;prev_final_texte&#39;, -50); return false;" title="Rétrécir la zone de saisie" />
	</div>
</div>