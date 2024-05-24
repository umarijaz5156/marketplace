import './bootstrap';

import Alpine from 'alpinejs';
import * as FilePond from 'filepond';

import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

import 'lazysizes';
// import a plugin
import 'lazysizes/plugins/parent-fit/ls.parent-fit';


FilePond.registerPlugin(FilePondPluginImagePreview);


import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';


FilePond.registerPlugin(FilePondPluginImageValidateSize);


import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';


FilePond.registerPlugin(FilePondPluginFileValidateType);

window.Alpine = Alpine;
window.FilePond = FilePond;

Alpine.start();
