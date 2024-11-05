!function(t){"use strict";var a=function(a,e){this.options=e,this.$tabs=t(a),this._accordionVisible=!1,this._initAccordion(),this._checkStateOnResize();var i=this;setTimeout((function(){i.checkState()}),0)};a.DEFAULTS={accordionClass:"visible-xs",tabsClass:"hidden-xs",accordionTemplate:function(t,a,e,i){return'<div class="card">   <div class="card-header">      <h5 class="card-title m-0">      </h5>   </div>   <div data-parent="#'+e+'" id="'+a+'" class="collapse '+(i?"show":"")+'">       <div class="card-body js-tabcollapse-panel-body">       </div>   </div></div>'}},a.prototype.checkState=function(){this.$tabs.is(":visible")&&this._accordionVisible?(this.showTabs(),this._accordionVisible=!1):this.$accordion.is(":visible")&&!this._accordionVisible&&(this.showAccordion(),this._accordionVisible=!0)},a.prototype.showTabs=function(){var a=this,e=this.getTabContentElement();this.$tabs.trigger(t.Event("show-tabs.bs.tabcollapse"));var i=this.$accordion.find(".js-tabcollapse-panel-heading").detach();e.find(".tab-pane").removeClass("active show"),i.each((function(){var i=t(this),s=i.data("bs.tabcollapse.parentLi"),o=a._panelHeadingToTabHeading(i);o.hasClass("collapsed")?o.removeClass("collapsed"):(i.addClass("active"),e.find(i.attr("href")).addClass("active show")),s.append(i)})),t(".nav-link").hasClass("active")||t("li").first().find(".nav-link").addClass("active show"),this.$accordion.find(".js-tabcollapse-panel-body").each((function(){var a=t(this);a.data("bs.tabcollapse.tabpane").append(a.contents().detach())})),this.$accordion.html(""),this.options.updateLinks&&e.find('[data-toggle-was="tab"], [data-toggle-was="pill"]').each((function(){var a=t(this),e=a.attr("href").replace(/-collapse$/g,"");a.attr({"data-toggle":a.attr("data-toggle-was"),"data-toggle-was":"","data-parent":"",href:e})})),this.$tabs.trigger(t.Event("shown-tabs.bs.tabcollapse"))},a.prototype.getTabContentElement=function(){var a=t(this.options.tabContentSelector);return 0===a.length&&(a=this.$tabs.siblings(".tab-content")),a},a.prototype.showAccordion=function(){this.$tabs.trigger(t.Event("show-accordion.bs.tabcollapse"));var a=this.$tabs.find('li:not(.dropdown) [data-toggle="tab"], li:not(.dropdown) [data-toggle="pill"]'),e=this;if(a.each((function(){var a=t(this),i=a.parent(),s=a.is(".active");a.data("bs.tabcollapse.parentLi",i),a.removeClass("active"),e.$accordion.append(e._createAccordionGroup(e.$accordion.attr("id"),a.detach(),s))})),this.options.updateLinks){var i=this.$accordion.attr("id");this.$accordion.find(".js-tabcollapse-panel-body").find('[data-toggle="tab"], [data-toggle="pill"]').each((function(){var a=t(this),e=a.attr("href")+"-collapse";a.attr({"data-toggle-was":a.attr("data-toggle"),"data-toggle":"collapse","data-parent":"#"+i,href:e})}))}this.$tabs.trigger(t.Event("shown-accordion.bs.tabcollapse"))},a.prototype._panelHeadingToTabHeading=function(t){var a=t.attr("href").replace(/-collapse$/g,"");return t.attr({"data-toggle":"tab",href:a,"data-parent":""}),t},a.prototype._tabHeadingToPanelHeading=function(t,a,e,i){return t.addClass("js-tabcollapse-panel-heading "+(i?"":"collapsed")),t.attr({"data-toggle":"collapse","data-parent":"#"+e,href:"#"+a}),t},a.prototype._checkStateOnResize=function(){var a=this;t(window).resize((function(){clearTimeout(a._resizeTimeout),a._resizeTimeout=setTimeout((function(){a.checkState()}),100)}))},a.prototype._initAccordion=function(){var a=this.$tabs.attr("id"),e=(a||function(){for(var t="",a="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",e=0;e<5;e++)t+=a.charAt(Math.floor(62*Math.random()));return t}())+"-accordion";this.$accordion=t('<div class="accordion '+this.options.accordionClass+'" id="'+e+'"></div>'),this.$tabs.after(this.$accordion),this.$tabs.addClass(this.options.tabsClass),this.getTabContentElement().addClass(this.options.tabsClass)},a.prototype._createAccordionGroup=function(a,e,i){var s=e.attr("data-target");s||(s=(s=e.attr("href"))&&s.replace(/.*(?=#[^\s]*$)/,""));var o=t(s),n=o.attr("id")+"-collapse",c=t(this.options.accordionTemplate(e,n,a,i));return c.find(".card-header > .card-title").append(this._tabHeadingToPanelHeading(e,n,a,i)),c.find(".card-body").append(o.contents().detach()).data("bs.tabcollapse.tabpane",o),c},t.fn.tabCollapse=function(e){return this.each((function(){var i=t(this),s=i.data("bs.tabcollapse"),o=t.extend({},a.DEFAULTS,i.data(),"object"==typeof e&&e);s||i.data("bs.tabcollapse",new a(this,o))}))},t.fn.tabCollapse.Constructor=a}(window.jQuery);
