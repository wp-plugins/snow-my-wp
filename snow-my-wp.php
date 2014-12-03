<?php
/**
 * @package Snow_My_WP
 * @version 0.1
 */
/*
Plugin Name: Snow My WP
Plugin URI: http://wordpress.org/plugins/snow-my-wp/
Description: A festive plugin for an awesome snowfall on your website.
Author: Chetan Vengurlekar
Version: 0.1
Author URI: http://www.sarvisolutions.com/author/chetan
*/
function snow_my_wp() {
?>
<!-- snow_my_wp [ start ] -->
<script type="text/javascript">
// Set the number of snowflakes (more than 30 - 40 not recommended)
var maxsnow=50
// Set the colors for the snow. Add as many colors as you like
var colorsnow=new Array("#aaaacc","#ddddff","#ccccdd","#f3f3f3","#f0ffff","#bbf7f9")
// Set the fonts, that create the snowflakes. Add as many fonts as you like
var typesnow=new Array("Times","Arial","Times","Verdana")
// Set the letter that creates your snowflake (recommended: * )
var lettersnow="*"
// Set the speed of sinking (recommended values range from 0.3 to 2)
var sinkspeed=0.6
// Set the maximum-size of your snowflakes
var maxsnowsize=30
// Set the minimal-size of your snowflakes
var minsnowsize=8
// Set the snowing-zone
// Set 1 for all-over-snowing, set 2 for left-side-snowing
// Set 3 for center-snowing, set 4 for right-side-snowing
var snowingzone=1
///////////////////////////////////////////////////////////////////////////
var snow=new Array()
var marginbottom
var marginright
var timer
var i_snow=0
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/)
var ns6=document.getElementById&&!document.all
var opera=browserinfos.match(/Opera/)
var browserok=ie5||ns6||opera
function randommaker(range) {
        rand=Math.floor(range*Math.random())
    return rand
}
function initsnow() {
        if (ie5 || opera) {
                marginbottom = document.body.scrollHeight
                marginright = document.body.clientWidth-15
        }
        else if (ns6) {
                marginbottom = document.body.scrollHeight
                marginright = window.innerWidth-15
        }
        var snowsizerange=maxsnowsize-minsnowsize
        for (i=0;i<=maxsnow;i++) {
                crds[i] = 0;
            lftrght[i] = Math.random()*15;
            x_mv[i] = 0.03 + Math.random()/10;
                snow[i]=document.getElementById("s"+i)
                snow[i].style.fontFamily=typesnow[randommaker(typesnow.length)]
                snow[i].size=randommaker(snowsizerange)+minsnowsize
                snow[i].style.fontSize=snow[i].size+'px';
                snow[i].style.color=colorsnow[randommaker(colorsnow.length)]
                snow[i].style.zIndex=1000
                snow[i].sink=sinkspeed*snow[i].size/5
                if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
                if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
                if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
                if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
                snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size)
                snow[i].style.left=snow[i].posx+'px';
                snow[i].style.top=snow[i].posy+'px';
        }
        movesnow()
}
function movesnow() {
        for (i=0;i<=maxsnow;i++) {
                crds[i] += x_mv[i];
                snow[i].posy+=snow[i].sink
                snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i])+'px';
                snow[i].style.top=snow[i].posy+'px';

                if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
                        if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
                        if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
                        if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
                        if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
                        snow[i].posy=0
                }
        }
        var timer=setTimeout("movesnow()",50)
}
for (i=0;i<=maxsnow;i++) {
        document.write("<span id='s"+i+"' style='position:absolute;top:-"+maxsnowsize+"'>"+lettersnow+"</span>")
}
if (browserok) {
        window.onload=initsnow
}
</script>
<!-- snow_my_wp [ end ] -->
<?php   
}
add_action('wp_footer','snow_my_wp'); 
?>
