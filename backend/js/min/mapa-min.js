window.mapa=function(a,o,n){function e(){var n=new google.maps.LatLng(o.marcador.mapa[0],o.marcador.mapa[1]),e=new google.maps.LatLng(o.mapa[0],o.mapa[1]),m={zoom:o.zoom,center:e,streetViewControl:!1,mapTypeId:o.tipo};i=new google.maps.Map(document.getElementById(a),m),google.maps.event.addListener(i,"click",function(a){t(a.latLng)}),t(n)}function t(a){p();var o=new google.maps.Marker({position:a,map:i});c.push(o),r(n,a.A,a.F)}function m(a){for(var o=0;o<c.length;o++)c[o].setMap(a)}function p(){m(null),c=[]}function r(a,o,n){g={mapa:[i.center.lat(),i.center.lng()],tipo:i.mapTypeId,zoom:i.zoom,marcador:{mapa:[o,n]}},$("#"+a).val(JSON.stringify(g))}$("#"+a).empty();var i,c=[],g={};setTimeout(function(){e()},2e3)};