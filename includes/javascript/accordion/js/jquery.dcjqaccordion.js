!function(s){s.fn.cutomAccordion=function(a){function e(a,e,i){var t=s.cookie(a);if(null!=t){var l=t.split(",");s.each(l,function(a,t){var l=s("li:eq("+t+")",e);s("> span",l).addClass(i);var n=l.parents("li");s("> span",n).addClass(i)})}}function i(a,e,i){var t=[];s("li a."+i,e).each(function(){var a=s(this).parent("li"),i=s("li",e).index(a);t.push(i)}),s.cookie(a,t,{path:"/"})}var t={classParent:"cutom-parent",classActive:"active",classArrow:"dcjq-icon",classCount:"dcjq-count",classExpand:"dcjq-current-parent",classDisable:"",eventType:"click",hoverDelay:300,menuClose:!0,autoClose:!0,autoExpand:!1,speed:"fast",saveState:!0,disableLink:!0,showCount:!1,cookie:"dcjq-accordion"},a=s.extend(t,a);this.each(function(){function a(){$arrow='<span class="'+t.classArrow+'"></span>';var a=t.classParent+"-li";$objSub.show(),s("li",u).each(function(){s("> ul",this).length>0&&(s(this).addClass(a),s("> span",this).addClass(t.classParent).append($arrow))}),$objSub.hide(),t.classDisable&&s("li."+t.classDisable+" > ul").show(),1==t.showCount&&s("li."+a,u).each(function(){if(1==t.disableLink)var a=parseInt(s("ul a:not(."+t.classParent+")",this).length);else var a=parseInt(s("ul span",this).length);s("> span",this).append(' <span class="'+t.classCount+'">('+a+")</span>")})}function l(){$activeLi=s(this).parent("li"),$parentsLi=$activeLi.parents("li"),$parentsUl=$activeLi.parents("ul"),1==t.autoClose&&v($parentsLi,$parentsUl),s("> ul",$activeLi).is(":visible")?(s("ul",$activeLi).slideUp(t.speed),s("span",$activeLi).removeClass(classActive)):(s(this).siblings("ul").slideToggle(t.speed),s("> span",$activeLi).addClass(classActive)),1==t.saveState&&i(t.cookie,u,classActive)}function n(){}function c(){}function o(){1==t.menuClose&&($objSub.slideUp(t.speed),s("span",u).removeClass(classActive),i(t.cookie,u,classActive))}function v(a,e){s("ul",u).not(e).slideUp(t.speed),s("span",u).removeClass(classActive),s("> span",a).addClass(classActive)}function r(){$objSub.hide();var a=s("span."+classActive,u).parents("li");s("> span",a).addClass(classActive),$allActiveLi=s("span."+classActive,u),s($allActiveLi).siblings("ul").show()}var u=this;if($objLinks=s("li > span",u),$objSub=s("li > ul",u),t.classDisable&&($objLinks=s("li:not(."+t.classDisable+") > span",u),$objSub=s("li:not(."+t.classDisable+") > ul",u)),classActive=t.classActive,a(),1==t.saveState&&e(t.cookie,u,classActive),1==t.autoExpand&&s("li."+t.classExpand+" > span").addClass(classActive),r(),"hover"==t.eventType){var p={sensitivity:2,interval:t.hoverDelay,over:l,timeout:t.hoverDelay,out:n};$objLinks.hoverIntent(p);var d={sensitivity:2,interval:1e3,over:c,timeout:1e3,out:o};s(u).hoverIntent(d),1==t.disableLink&&$objLinks.click(function(a){s(this).siblings("ul").length>0&&a.preventDefault()})}else $objLinks.click(function(a){$activeLi=s(this).parent("li"),$parentsLi=$activeLi.parents("li"),$parentsUl=$activeLi.parents("ul"),1==t.disableLink&&s(this).siblings("ul").length>0&&a.preventDefault(),1==t.autoClose&&v($parentsLi,$parentsUl),s("> ul",$activeLi).is(":visible")?(s("ul",$activeLi).slideUp(t.speed),s("span",$activeLi).removeClass(classActive)):(s(this).siblings("ul").slideToggle(t.speed),s("> span",$activeLi).addClass(classActive)),1==t.saveState&&i(t.cookie,u,classActive)})})}}(jQuery);