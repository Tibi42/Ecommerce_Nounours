import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file is included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
// Import Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';
// Import Bootstrap JS (si vous avez besoin des fonctionnalités JS)
import 'bootstrap';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');