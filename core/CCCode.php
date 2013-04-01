<?php

class CCCode
{
    public static function parser($contenu)
    {
        $code = array(
            '`&lt;taille valeur=&quot;ttpetit&quot;&gt;(.+)&lt;/taille&gt;`isU',
            '`&lt;taille valeur=&quot;tpetit&quot;&gt;(.+)&lt;/taille&gt;`isU',
            '`&lt;taille valeur=&quot;petit&quot;&gt;(.+)&lt;/taille&gt;`isU',
            '`&lt;taille valeur=&quot;gros&quot;&gt;(.+)&lt;/taille&gt;`isU',
            '`&lt;taille valeur=&quot;tgros&quot;&gt;(.+)&lt;/taille&gt;`isU',
            '`&lt;taille valeur=&quot;ttgros&quot;&gt;(.+)&lt;/taille&gt;`isU',
            '`&lt;gras&gt;(.+)&lt;/gras&gt;`isU',
            '`&lt;italique&gt;(.+)&lt;/italique&gt;`isU',
            '`&lt;souligne&gt;(.+)&lt;/souligne&gt;`isU',
            '`&lt;barre&gt;(.+)&lt;/barre&gt;`isU',
            '`&lt;exposant&gt;(.+)&lt;/exposant&gt;`isU',
            '`&lt;indice&gt;(.+)&lt;/indice&gt;`isU',
            '`&lt;information&gt;(.+)&lt;/information&gt;`isU',
            '`&lt;attention&gt;(.+)&lt;/attention&gt;`isU',
            '`&lt;erreur&gt;(.+)&lt;/erreur&gt;`isU',
            '`&lt;question&gt;(.+)&lt;/question&gt;`isU',
            '`&lt;lien&gt;(.+)&lt;/lien&gt;`isU',
            '`&lt;lien url=&quot;(.+)&quot;&gt;(.+)&lt;/lien&gt;`isU',
            '`&lt;email nom=&quot;(.+)&quot;&gt;(.+)&lt;/email&gt;`isU',
            '`&lt;email&gt;(.+)&lt;/email&gt;`isU',
            '`&lt;image&gt;(.+)&lt;/image&gt;`isU',
            '`&lt;citation&gt;(.+)&lt;/citation&gt;`isU',
            '`&lt;secret&gt;(.+)&lt;/secret&gt;`isU',
            '`&lt;secret cache=&quot;1&quot;&gt;(.+)&lt;/secret&gt;`isU',
            '`&lt;position valeur=&quot;droite&quot;&gt;(.+)&lt;/position&gt;`isU',
            '`&lt;position valeur=&quot;gauche&quot;&gt;(.+)&lt;/position&gt;`isU',
            '`&lt;position valeur=&quot;centre&quot;&gt;(.+)&lt;/position&gt;`isU',
            '`&lt;flottant valeur=&quot;gauche&quot;&gt;(.+)&lt;/flottant&gt;`isU',
            '`&lt;flottant valeur=&quot;droite&quot;&gt;(.+)&lt;/flottant&gt;`isU',
            '`&lt;tableau&gt;(.+)&lt;/tableau&gt;`isU',
            '`&lt;ligne&gt;(.+)&lt;/ligne&gt;`isU',
            '`&lt;entete&gt;(.+)&lt;/entete&gt;`isU',
            '`&lt;cellule&gt;(.+)&lt;/cellule&gt;`isU',
            '`&lt;liste&gt;(.+)&lt;/liste&gt;`isU',
            '`&lt;puce&gt;(.+)&lt;/puce&gt;`isU',
            '`&lt;couleur nom=&quot;rouge&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;orange&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;jaune&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;vertc&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;vertf&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;bleu&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;marron&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;noir&quot;&gt;(.+)&lt;/couleur&gt;`isU',
            '`&lt;couleur nom=&quot;gris&quot;&gt;(.+)&lt;/couleur&gt;`isU'
        );

        $html = array(
            '<span class="ttpetit">$1</span>',
            '<span class="tpetit">$1</span>',
            '<span class="petit">$1</span>',
            '<span class="gros">$1</span>',
            '<span class="tgros">$1</span>',
            '<span class="ttgros">$1</span>',
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<del>$1</del>',
            '<sup>$1</sup>',
            '<sub>$1</sub>',
            '</p><p class="style info">$1</p><p>',
            '</p><p class="style attention">$1</p><p>',
            '</p><p class="style erreur">$1</p><p>',
            '</p><p class="style question">$1</p><p>',
            '<a href="$1">$1</a>',
            '<a href="$1" title="$2">$2</a>',
            '<a href="mailto:$1" title="Envoyer un e-mail à $1">$2</a>',
            '<a href="mailto:$1">$1</a>',
            '<img src="images/articles/mini/$1" alt="$1" />',
            '</p><blockquote><p>$1</p></blockquote><p>',
            '</p><span class="secret">Texte caché <a href="#" onclick="switch_spoiler(this); return false;">(cliquez pour afficher)</a></span><div class="secret"><div class="spoiler_1">$1</div></div><p>',
            '</p><span class="secret">Texte caché <a href="#" onclick="switch_spoiler_hidden(this); return false;">(cliquez pour afficher)</a></span><div class="secret"><div class="spoiler_2">$1</div></div><p>',
            '</p><p class="right">$1</p><p>',
            '</p><p class="left">$1</p><p>',
            '</p><p class="center">$1</><p>',
            '</p><div class="flottant_gauche">$1</div><p>',
            '</p><div class="flottant_droite">$1</div><p>',
            '</p><table class="visible">$1</table><p>',
            '<tr>$1</tr>',
            '<th class="visible">$1</th>',
            '<td class="visible">$1</td>',
            '</p><ul>$1</ul><p>',
            '<li>$1</li>',
            '<span class="rouge">$1</span>',
            '<span class="orange">$1</span>',
            '<span class="jaune">$1</span>',
            '<span class="vertc">$1</span>',
            '<span class="vertf">$1</span>',
            '<span class="bleu">$1</span>',
            '<span class="marron">$1</span>',
            '<span class="noir">$1</span>',
            '<span class="gris">$1</span>'
        );

        $contenu = htmlspecialchars($contenu);
        $contenu = preg_replace($code, $html, $contenu);

        $contenu = preg_replace('#<ul>(\s)*<li>#sU', '<ul><li>', $contenu);
        $contenu = preg_replace('#</li>(\s)*<li>#sU', '</li><li>', $contenu);
        $contenu = preg_replace('#</li>(\s)*</ul>#sU', '</li></ul>', $contenu);

        $contenu = preg_replace('#<table class="visible">(\s)*<tr>#sU', '<table class="visible"><tr>', $contenu);
        $contenu = preg_replace('#<tr>(\s)*<th class="visible">#sU', '<tr><th class="visible">', $contenu);
        $contenu = preg_replace('#<tr>(\s)*<td class="visible">#sU', '<tr><td class="visible">', $contenu);
        $contenu = preg_replace('#</td>(\s)*<td class="visible">#sU', '</td><td class="visible">', $contenu);
        $contenu = preg_replace('#</td>(\s)*</tr>#sU', '</td></tr>', $contenu);
        $contenu = preg_replace('#</th>(\s)*<th class="visible">#sU', '</th><th class="visible">', $contenu);
        $contenu = preg_replace('#</th>(\s)*</tr>#sU', '</th></tr>', $contenu);
        $contenu = preg_replace('#</tr>(\s)*<tr>#sU', '</tr><tr>', $contenu);
        $contenu = preg_replace('#</tr>(\s)*</table>#sU', '</tr></table>', $contenu);

        $contenu = preg_replace('`\n`isU','<br />',$contenu);

        return $contenu;
    }
}
