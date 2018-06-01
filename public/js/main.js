'use strict';

// Init all plugin when document is ready 
$(document).on('ready', function () {
	// 0. Init console to avoid error
	var method;
	var noop = function () { };
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});
	while (length--) {
		method = methods[length];
		// Only stub undefined methods.
		if (!console[method]) {
			console[method] = noop;
		}
	}


	// 1. Background image as data attribut 
	var list = $('.bg-img');
	for (var i = 0; i < list.length; i++) {
		var src = list[i].getAttribute('data-image-src');
		list[i].style.backgroundImage = "url('" + src + "')";
		list[i].style.backgroundRepeat = "no-repeat";
		list[i].style.backgroundPosition = "center";
		list[i].style.backgroundSize = "cover";
	}
	// Background color as data attribut
	var list = $('.bg-color');
	for (var i = 0; i < list.length; i++) {
		var src = list[i].getAttribute('data-bgcolor');
		list[i].style.backgroundColor = src;
	}



	// 3. Show/hide menu when icon is clicked
	var menuItems = $('.top-menu-links, .main-menu');
	var menuIcon = $('.menu-icon, #menu-link');
	var menuLinks = $(".top-menu-links a, .main-menu a");
	// Menu icon clicked
	menuIcon.on('click', function () {
		menuIcon.toggleClass('menu-visible')
		menuItems.toggleClass('menu-visible');
		return false;
	});

	// Hide menu after a menu item clicked
	menuLinks.on('click', function () {
		if (menuItems.hasClass('menu-visible')) {
			menuIcon.removeClass('menu-visible');
			menuItems.removeClass('menu-visible');
		}
		return true;
	});


	// 8. Init fullPage.js plugin
	var pageSectionDivs = $('.fullpg .section');
	var headerLogo = $('.header-top .logo');
	var bodySelector = $('body');
	var sectionSelector = $('.section');
	var headerContainer = $('.hh-header');
	var slideElem = $('.slide');
	var arrowElem = $('.p-footer .arrow-d');
	var pageElem = $('.section');
	var pageSections = [];
	var pageAnchors = [];
	var nextSectionDOM;
	var nextSection;
	var fpnavItem;
	var mainPage = $('#mainpage');
	var sendEmailForm = $('.send_email_form');
	var sendMessageForm = $('.send_message_form');
	var scrollOverflow = true;
	// disable scroll overflow on small device
	if ($(window).width() < 601) {
		scrollOverflow = false;
	}
	else {
		scrollOverflow = true;
	}
	// Get sections name
	for (var i = 0; i < pageSectionDivs.length; i++) {
		pageSections.push(pageSectionDivs[i]);
	}
	window.asyncEach(pageSections, function (pageSection, cb) {
		var anchor = pageSection.getAttribute('data-section');
		pageAnchors.push(anchor + "");
		cb();
	}, function (err) {
		// Init plugin
		if (mainPage.height()) {
			// config fullpage.js
			mainPage.fullpage({
				menu: '#qmenu',
				anchors: pageAnchors,
				verticalCentered: false,
				css3: true,
				navigation: true,
				responsiveWidth: 601,
				responsiveHeight: 401,
				scrollOverflow: scrollOverflow,
				scrollOverflowOptions: {
					click: true,
					submit: true,
				},
				afterRender: function () {
					// // Fired when page is rendered
					// // Append scroll down text to fpnav
					// var fpNav = $('#fp-nav');
					// fpNav.remove();
					// bodySelector.append('<div id="fp-nav-wrapper"></div>');
					// var fpNavWrapper = $('#fp-nav-wrapper');
					// fpNavWrapper.append(fpNav);
					// fpNavWrapper.append($('.site-footer .scrolldown'));


				},
				afterResize: function () {
					// var pluginContainer = $(this);
					// $.fn.fullpage.reBuild();
				},
				onLeave: function (index, nextIndex, direction) {
					// // Behavior when a full page is leaved
					// arrowElem.addClass('gone');
					// pageElem.addClass('transition');
					// slideElem.removeClass('transition');
					// pageElem.removeClass('transition');
                    //
					// nextSectionDOM = sectionSelector[(nextIndex - 1)];
					// nextSection = $(nextSectionDOM);
					// if (nextSection.hasClass('dark-bg')) {
					// 	bodySelector.addClass('dark-section');
					// 	headerLogo.addClass('dark-bg');
					// }
					// else {
					// 	bodySelector.removeClass('dark-section');
					// 	headerLogo.removeClass('dark-bg');
					// }
				},
				afterLoad: function (anchorLink, index) {

				}
			});

		}
	});
	// Scroll to fullPage.js next/previous section
	$('.scrolldown a').on('click', function () {
		$.fn.fullpage.moveSectionDown();
	});
});


