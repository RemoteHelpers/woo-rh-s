(function(){this.Calendly={};this.Calendly._util={}}).call(this);Calendly._util.domReady=function(callback){var ready=!1;var detach=function(){if(document.addEventListener){document.removeEventListener("DOMContentLoaded",completed);window.removeEventListener("load",completed)}else{document.detachEvent("onreadystatechange",completed);window.detachEvent("onload",completed)}}
var completed=function(){if(!ready&&(document.addEventListener||event.type==="load"||document.readyState==="complete")){ready=!0;detach();callback()}};if(document.readyState==="complete"){callback()}else if(document.addEventListener){document.addEventListener("DOMContentLoaded",completed);window.addEventListener("load",completed)}else{document.attachEvent("onreadystatechange",completed);window.attachEvent("onload",completed);var top=!1;try{top=window.frameElement==null&&document.documentElement}catch(e){}
if(top&&top.doScroll){(function scrollCheck(){if(ready)return;try{top.doScroll("left")}catch(e){return setTimeout(scrollCheck,50)}
ready=!0;detach();callback()})()}}};Calendly._util.assign=function assign(target,varArgs){'use strict';if(target==null){throw new TypeError('Cannot convert undefined or null to object')}
var to=Object(target);for(var index=1;index<arguments.length;index++){var nextSource=arguments[index];if(nextSource!=null){for(var nextKey in nextSource){if(Object.prototype.hasOwnProperty.call(nextSource,nextKey)){to[nextKey]=nextSource[nextKey]}}}}
return to};(function(){Calendly._url={};Calendly._url.extractQueryStringParams=function(url){var i,key,len,param,paramString,params,parser,ref,ref1,value;parser=document.createElement('a');parser.href=url;paramString=parser.search.substr(1);params={};ref=paramString.split('&');for(i=0,len=ref.length;i<len;i++){param=ref[i];ref1=param.split('='),key=ref1[0],value=ref1[1];if(value!==void 0){params[key.toLowerCase()]=decodeURIComponent(value)}}
return params};Calendly._url.stripQuery=function(url){return url.split('?')[0]}}).call(this);(function(){Calendly._util.snakeCaseKeys=function(options){var convertedKey,key,result;result={};for(key in options){convertedKey=key.split(/(?=[A-Z])/).join('_').toLowerCase();result[convertedKey]=options[key]}
return result};Calendly._util.pick=function(options,keyWhitelist){var i,key,len,result;if(!options){return}
result={};for(i=0,len=keyWhitelist.length;i<len;i++){key=keyWhitelist[i];if(options[key]){result[key]=options[key]}}
return result}}).call(this);(function(global,factory){var mod={exports:{}};if(typeof define==="function"&&define.amd){define(['exports'],factory)}else if(typeof exports!=="undefined"){mod.exports=exports}
factory(mod.exports);global.bodyScrollLock=mod.exports})(this,function(exports){'use strict';Object.defineProperty(exports,"__esModule",{value:!0});function _toConsumableArray(arr){if(Array.isArray(arr)){for(var i=0,arr2=Array(arr.length);i<arr.length;i++){arr2[i]=arr[i]}
return arr2}else{return Array.from(arr)}}
var hasPassiveEvents=!1;if(typeof window!=='undefined'){var passiveTestOptions={get passive(){hasPassiveEvents=!0;return undefined}};window.addEventListener('testPassive',null,passiveTestOptions);window.removeEventListener('testPassive',null,passiveTestOptions)}
var isIosDevice=typeof window!=='undefined'&&window.navigator&&window.navigator.platform&&/iP(ad|hone|od)/.test(window.navigator.platform);var locks=[];var documentListenerAdded=!1;var initialClientY=-1;var previousBodyOverflowSetting=void 0;var previousBodyPaddingRight=void 0;var allowTouchMove=function allowTouchMove(el){return locks.some(function(lock){if(lock.options.allowTouchMove&&lock.options.allowTouchMove(el)){return!0}
return!1})};var preventDefault=function preventDefault(rawEvent){var e=rawEvent||window.event;if(allowTouchMove(e.target)){return!0}
if(e.touches.length>1)return!0;if(e.preventDefault)e.preventDefault();return!1};var setOverflowHidden=function setOverflowHidden(options){setTimeout(function(){if(previousBodyPaddingRight===undefined){var _reserveScrollBarGap=!!options&&options.reserveScrollBarGap===!0;var scrollBarGap=window.innerWidth-document.documentElement.clientWidth;if(_reserveScrollBarGap&&scrollBarGap>0){previousBodyPaddingRight=document.body.style.paddingRight;document.body.style.paddingRight=scrollBarGap+'px'}}
if(previousBodyOverflowSetting===undefined){previousBodyOverflowSetting=document.body.style.overflow;document.body.style.overflow='hidden'}})};var restoreOverflowSetting=function restoreOverflowSetting(){setTimeout(function(){if(previousBodyPaddingRight!==undefined){document.body.style.paddingRight=previousBodyPaddingRight;previousBodyPaddingRight=undefined}
if(previousBodyOverflowSetting!==undefined){document.body.style.overflow=previousBodyOverflowSetting;previousBodyOverflowSetting=undefined}})};var isTargetElementTotallyScrolled=function isTargetElementTotallyScrolled(targetElement){return targetElement?targetElement.scrollHeight-targetElement.scrollTop<=targetElement.clientHeight:!1};var handleScroll=function handleScroll(event,targetElement){var clientY=event.targetTouches[0].clientY-initialClientY;if(allowTouchMove(event.target)){return!1}
if(targetElement&&targetElement.scrollTop===0&&clientY>0){return preventDefault(event)}
if(isTargetElementTotallyScrolled(targetElement)&&clientY<0){return preventDefault(event)}
event.stopPropagation();return!0};var disableBodyScroll=exports.disableBodyScroll=function disableBodyScroll(targetElement,options){if(isIosDevice){if(!targetElement){console.error('disableBodyScroll unsuccessful - targetElement must be provided when calling disableBodyScroll on IOS devices.');return}
if(targetElement&&!locks.some(function(lock){return lock.targetElement===targetElement})){var lock={targetElement:targetElement,options:options||{}};locks=[].concat(_toConsumableArray(locks),[lock]);targetElement.ontouchstart=function(event){if(event.targetTouches.length===1){initialClientY=event.targetTouches[0].clientY}};targetElement.ontouchmove=function(event){if(event.targetTouches.length===1){handleScroll(event,targetElement)}};if(!documentListenerAdded){document.addEventListener('touchmove',preventDefault,hasPassiveEvents?{passive:!1}:undefined);documentListenerAdded=!0}}}else{setOverflowHidden(options);var _lock={targetElement:targetElement,options:options||{}};locks=[].concat(_toConsumableArray(locks),[_lock])}};var clearAllBodyScrollLocks=exports.clearAllBodyScrollLocks=function clearAllBodyScrollLocks(){if(isIosDevice){locks.forEach(function(lock){lock.targetElement.ontouchstart=null;lock.targetElement.ontouchmove=null});if(documentListenerAdded){document.removeEventListener('touchmove',preventDefault,hasPassiveEvents?{passive:!1}:undefined);documentListenerAdded=!1}
locks=[];initialClientY=-1}else{restoreOverflowSetting();locks=[]}};var enableBodyScroll=exports.enableBodyScroll=function enableBodyScroll(targetElement){if(isIosDevice){if(!targetElement){console.error('enableBodyScroll unsuccessful - targetElement must be provided when calling enableBodyScroll on IOS devices.');return}
targetElement.ontouchstart=null;targetElement.ontouchmove=null;locks=locks.filter(function(lock){return lock.targetElement!==targetElement});if(documentListenerAdded&&locks.length===0){document.removeEventListener('touchmove',preventDefault,hasPassiveEvents?{passive:!1}:undefined);documentListenerAdded=!1}}else{locks=locks.filter(function(lock){return lock.targetElement!==targetElement});if(!locks.length){restoreOverflowSetting()}}}});(function(){var createBadgeWidget,createInlineWidgets,extractBadgeOptions,findInlineParentElement,shouldSkipAutoLoadInlineWidget;Calendly._autoLoadInlineWidgets=function(){return Calendly._util.domReady(function(){return createInlineWidgets()})};Calendly.initBadgeWidget=function(options){return Calendly._util.domReady(function(){return createBadgeWidget(options)})};Calendly.destroyBadgeWidget=function(){if(!Calendly.badgeWidget){return}
Calendly.badgeWidget.destroy();return delete Calendly.badgeWidget};Calendly.initPopupWidget=function(options){return Calendly._util.domReady(function(){return Calendly.showPopupWidget(options.url,'PopupText',options)})};Calendly.initInlineWidget=function(options){if(!options.url){return}
if(!options.parentElement){options.parentElement=findInlineParentElement()}
return Calendly._util.domReady(function(){options.embedType='Inline';return new Calendly.Iframe(options)})};Calendly.showPopupWidget=function(url,embedType,options){var onCloseHandler;if(embedType==null){embedType='PopupText'}
if(options==null){options={}}
this.closePopupWidget();onCloseHandler=function(){return delete Calendly.popupWidget};Calendly.popupWidget=new Calendly.PopupWidget(url,onCloseHandler,embedType,options);return Calendly.popupWidget.show()};Calendly.closePopupWidget=function(){if(!Calendly.popupWidget){return}
return Calendly.popupWidget.close()};findInlineParentElement=function(){var thisScript;thisScript=document.scripts[document.scripts.length-1];return thisScript.parentNode};createInlineWidgets=function(){var element,elements,i,len,results;elements=document.querySelectorAll('.calendly-inline-widget');results=[];for(i=0,len=elements.length;i<len;i++){element=elements[i];if(!shouldSkipAutoLoadInlineWidget(element)){element.setAttribute('data-processed',!0);results.push(new Calendly.Iframe({parentElement:element,inlineStyles:!0,embedType:'Inline'}))}else{results.push(void 0)}}
return results};shouldSkipAutoLoadInlineWidget=function(element){return element.getAttribute('data-processed')||element.getAttribute('data-auto-load')==='false'};createBadgeWidget=function(options){var badgeOptions,initBadgeOptions,onClickHandler;Calendly.destroyBadgeWidget();badgeOptions=extractBadgeOptions(options);onClickHandler=function(){return Calendly.showPopupWidget(options.url,'PopupWidget',options)};initBadgeOptions=Calendly._util.assign({onClick:onClickHandler},badgeOptions);return Calendly.badgeWidget=new Calendly.BadgeWidget(initBadgeOptions)};extractBadgeOptions=function(options){var badgeKeys,badgeOptions;badgeKeys=['color','textColor','text','branding'];badgeOptions={};badgeKeys.forEach(function(key){badgeOptions[key]=options[key];return delete options[key]});return badgeOptions}}).call(this);(function(){Calendly.Iframe=(function(){Iframe.prototype.isMobile=/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);function Iframe(options){this.options=options;this.parseOptions();this.build();this.inject()}
Iframe.prototype.parseOptions=function(){var defaultOptions;defaultOptions={inlineStyles:!1};this.options=Calendly._util.assign({},defaultOptions,this.options);this.parent=this.options.parentElement;if(!this.parent){throw 'Calendly: Parent element not set'}
if(this.parent.jquery){this.parent=this.parent[0]}
this.inlineStyles=this.options.inlineStyles;this.embedType=this.options.embedType;this.url=(this.options.url||this.getUrlFromParent()).split('#')[0];if(!this.url){throw 'Calendly: Widget URL not set'}};Iframe.prototype.build=function(){this.node=document.createElement('iframe');this.node.src=this.getSource();this.node.width='100%';this.node.height='100%';return this.node.frameBorder='0'};Iframe.prototype.inject=function(){this.format();this.parent.appendChild(this.buildSpinner());return this.parent.appendChild(this.node)};Iframe.prototype.getSource=function(){return(Calendly._url.stripQuery(this.url))+"?"+(this.getParams())};Iframe.prototype.getUrlFromParent=function(){return this.parent.getAttribute('data-url')};Iframe.prototype.getParams=function(){var key,params,parts,value;params={embed_domain:this.getDomain(),embed_type:this.embedType};params=Calendly._util.assign(params,this.getUtmParamsFromHost(),this.getParamsFromUrl(),this.getParamsFromOptions());parts=[];for(key in params){value=params[key];parts.push(key+"="+(encodeURIComponent(value)))}
return parts.join('&')};Iframe.prototype.getUtmParamsFromHost=function(){var keyFilters,queryStringParams;keyFilters=['utm_campaign','utm_source','utm_medium','utm_content','utm_term'];queryStringParams=Calendly._url.extractQueryStringParams(window.location.href);return Calendly._util.pick(queryStringParams,keyFilters)};Iframe.prototype.getParamsFromUrl=function(){return Calendly._url.extractQueryStringParams(this.url)};Iframe.prototype.getParamsFromOptions=function(){return Calendly._util.assign({},this.getPrefillParams(),this.getUtmParams())};Iframe.prototype.getUtmParams=function(){var keyFilters;if(!this.options.utm){return null}
keyFilters=['utmCampaign','utmSource','utmMedium','utmContent','utmTerm'];return Calendly._util.snakeCaseKeys(Calendly._util.pick(this.options.utm,keyFilters))};Iframe.prototype.getPrefillParams=function(){var key,keyFilters,params,ref,value;if(!this.options.prefill){return null}
keyFilters=['name','firstName','lastName','email'];params=Calendly._util.snakeCaseKeys(Calendly._util.pick(this.options.prefill,keyFilters));if(this.options.prefill.customAnswers){ref=this.options.prefill.customAnswers;for(key in ref){value=ref[key];if(key.match(/^a\d{1,2}$/)){params[key]=value}}}
return params};Iframe.prototype.getDomain=function(){return document.location.host};Iframe.prototype.format=function(){if(this.isMobile){return this.formatMobile()}else{return this.formatDesktop()}};Iframe.prototype.formatDesktop=function(){if(this.inlineStyles){return this.parent.setAttribute('style','position: relative;'+this.parent.getAttribute('style'))}};Iframe.prototype.formatMobile=function(){if(this.inlineStyles){return this.parent.setAttribute('style','position: relative;overflow-y:auto;-webkit-overflow-scrolling:touch;'+this.parent.getAttribute('style'))}else{return this.parent.className+=' calendly-mobile'}};Iframe.prototype.buildSpinner=function(){var spinner;spinner=document.createElement('div');spinner.className='calendly-spinner';spinner.appendChild(this.buildBounce(1));spinner.appendChild(this.buildBounce(2));spinner.appendChild(this.buildBounce(3));return spinner};Iframe.prototype.buildBounce=function(number){var bounce;bounce=document.createElement('div');bounce.className="calendly-bounce"+number;return bounce};return Iframe})()}).call(this);(function(){var bind=function(fn,me){return function(){return fn.apply(me,arguments)}};Calendly.PopupWidget=(function(){function PopupWidget(url,onClose,embedType,options){this.url=url;this.onClose=onClose;this.embedType=embedType;this.options=options!=null?options:{};this.close=bind(this.close,this)}
PopupWidget.prototype.show=function(){this.buildOverlay();this.insertOverlay();return this.lockPageScroll()};PopupWidget.prototype.close=function(){this.unlockPageScroll();this.destroyOverlay();return this.onClose()};PopupWidget.prototype.buildOverlay=function(){this.overlay=document.createElement('div');this.overlay.className='calendly-overlay';this.overlay.appendChild(this.buildCloseOverlay());this.overlay.appendChild(this.buildPopup());return this.overlay.appendChild(this.buildCloseButton())};PopupWidget.prototype.insertOverlay=function(){return document.body.appendChild(this.overlay)};PopupWidget.prototype.buildCloseOverlay=function(){var node;node=document.createElement('div');node.className='calendly-close-overlay';node.onclick=this.close;return node};PopupWidget.prototype.buildPopup=function(){var node;node=document.createElement('div');node.className='calendly-popup';node.appendChild(this.buildPopupContent());return node};PopupWidget.prototype.buildPopupContent=function(){var node;node=document.createElement('div');node.className='calendly-popup-content';node.setAttribute('data-url',this.url);this.options.parentElement=node;this.options.embedType=this.embedType;new Calendly.Iframe(this.options);return node};PopupWidget.prototype.buildCloseButton=function(){var node;node=document.createElement('div');node.className='calendly-popup-close';node.onclick=this.close;return node};PopupWidget.prototype.destroyOverlay=function(){return this.overlay.parentNode.removeChild(this.overlay)};PopupWidget.prototype.lockPageScroll=function(){bodyScrollLock.disableBodyScroll(this.overlay);return document.addEventListener('touchmove',this.handleLockedTouchmove,{passive:!1})};PopupWidget.prototype.unlockPageScroll=function(){bodyScrollLock.enableBodyScroll(this.overlay);return document.removeEventListener('touchmove',this.handleLockedTouchmove,{passive:!1})};PopupWidget.prototype.handleLockedTouchmove=function(event){return event.preventDefault()};return PopupWidget})()}).call(this);(function(){Calendly.BadgeWidget=(function(){function BadgeWidget(options){this.options=options;this.buildWidget();this.insertWidget()}
BadgeWidget.prototype.destroy=function(){return this.widget.parentNode.removeChild(this.widget)};BadgeWidget.prototype.buildWidget=function(){this.widget=document.createElement('div');this.widget.className='calendly-badge-widget';return this.widget.appendChild(this.buildContent())};BadgeWidget.prototype.insertWidget=function(){return document.body.insertBefore(this.widget,document.body.firstChild)};BadgeWidget.prototype.buildContent=function(){var element;element=document.createElement('div');element.className='calendly-badge-content';if(this.options.color==='#ffffff'){element.className+=' calendly-white'}
element.onclick=this.options.onClick;element.innerHTML=this.options.text;element.style.background=this.options.color;element.style.color=this.options.textColor;if(this.options.branding){element.appendChild(this.buildBranding())}
return element};BadgeWidget.prototype.buildBranding=function(){var element;element=document.createElement('span');element.innerHTML='powered by Calendly';return element};return BadgeWidget})()}).call(this);Calendly._autoLoadInlineWidgets()