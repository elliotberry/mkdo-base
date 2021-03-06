// Hello? What's all this jQuery? We'll have no libraries here!
// Are you vanilla? This is a vanilla file, for vanilla people! There's nothing for jQuery folk here!

// Images, svgs and fonts.
function requireAll(r) {
	r.keys().forEach(r);
}
requireAll(require.context('../images/', true, /\.(png|jpg|gif)$/));
requireAll(require.context('../svgs/', true, /\.(svg)$/));
requireAll(require.context('../fonts/', true, /\.(woff(2)?|ttf|eot)$/));

// JS
import userAgentClasses from './modules/user-agent-classes.js';

// Run
userAgentClasses();

// Modules.
import {
	deBounce,
	isHighDensity,
	isRetina,
	compareRetina,
	compareBreakpoint,
} from './modules/utils.js';
import trackFocus from './modules/track-focus.js';
import skipLink from './modules/skip-link.js';
import styleGuide from './modules/style-guide.js';
import initResponsiveBackgroundImages from './modules/rwd-bg-images.js';
import { menuToggle } from './modules/toggles.js';

// Ready.
window.addEventListener('DOMContentLoaded', function() {
	// Replace no-js with js on the root HTML element.
	document.documentElement.className =
		document.documentElement.className.replace(/\bno-js\b/g, '') + ' js ';
	trackFocus(document.body);
	skipLink();
	styleGuide();
	initResponsiveBackgroundImages();
	menuToggle();
});

// Load.
window.addEventListener('load', function() {
	responsiveBackgroundImages('.js-bg-img');
});

// Resize
window.addEventListener(
	'resize',
	deBounce(() => {
		responsiveBackgroundImages('.js-bg-img');
	}, 100),
);
