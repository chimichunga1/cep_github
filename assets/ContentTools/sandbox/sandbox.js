(function () {
    var ImageUploader;

    ImageUploader = (function () {
        ImageUploader.imagePath = 'image.png';

        ImageUploader.imageSize = [600, 174];

        function ImageUploader(dialog) {
            this._dialog = dialog;
            this._dialog.addEventListener('cancel', (function (_this) {
                return function () {
                    return _this._onCancel();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.cancelupload', (function (_this) {
                return function () {
                    return _this._onCancelUpload();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.clear', (function (_this) {
                return function () {
                    return _this._onClear();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.fileready', (function (_this) {
                return function (ev) {
                    //return _this._onFileReady(ev.detail().file);

                    // Upload a file to the server
                    var formData;
                    var file = ev.detail().file;

                    // Define functions to handle upload progress and completion
                    xhrProgress = function (ev) {
                        // Set the progress for the upload
                        dialog.progress((ev.loaded / ev.total) * 100);
                    }

                    xhrComplete = function (ev) {
                        var response;

                        // Check the request is complete
                        if (ev.target.readyState != 4) {
                            return;
                        }

                        // Clear the request
                        xhr = null
                        xhrProgress = null
                        xhrComplete = null

                        // Handle the result of the upload
                        if (parseInt(ev.target.status) == 200) {
                            // Unpack the response (from JSON)
                            console.log(ev.target.responseText);
                            response = JSON.parse(ev.target.responseText);
                            // Store the image details
                            var t1 = response.url;
                            var t2 = t1.replace("%2f", "\\");
                            image = {
                                url: t2,
                                width: parseInt(response.width),
                                height: parseInt(response.height)
                            };

                            // Populate the dialog
                            dialog.populate(image.url, [image.width, image.height]);

                        } else {
                            // The request failed, notify the user
                            new ContentTools.FlashUI('no');
                        }
                    }

                    // Set the dialog state to uploading and reset the progress bar to 0
                    dialog.state('uploading');
                    dialog.progress(0);

                    // Build the form data to post to the server
                    formData = new FormData();
                    formData.append('image', file);

                    // Make the request
                    xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', xhrProgress);
                    xhr.addEventListener('readystatechange', xhrComplete);
                    xhr.open('POST', '../../Backend/upload-image-content.cshtml', true);
                    xhr.send(formData);
                };
            })(this));
            this._dialog.addEventListener('imageuploader.mount', (function (_this) {
                return function () {
                    return _this._onMount();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.rotateccw', (function (_this) {
                return function () {
                    return _this._onRotateCCW();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.rotatecw', (function (_this) {
                return function () {
                    return _this._onRotateCW();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.save', (function (_this) {
                return function () {
                    return _this._onSave();
                };
            })(this));
            this._dialog.addEventListener('imageuploader.unmount', (function (_this) {
                return function () {
                    return _this._onUnmount();
                };
            })(this));
        }

        ImageUploader.prototype._onCancel = function () { };

        ImageUploader.prototype._onCancelUpload = function () {
            clearTimeout(this._uploadingTimeout);
            return this._dialog.state('empty');
        };

        ImageUploader.prototype._onClear = function () {
            return this._dialog.clear();
        };

        ImageUploader.prototype._onMount = function () { };

        ImageUploader.prototype._onRotateCCW = function () {
            var clearBusy;
            this._dialog.busy(true);
            clearBusy = (function (_this) {
                return function () {
                    return _this._dialog.busy(false);
                };
            })(this);
            return setTimeout(clearBusy, 1500);
        };

        ImageUploader.prototype._onRotateCW = function () {
            var clearBusy;
            this._dialog.busy(true);
            clearBusy = (function (_this) {
                return function () {
                    return _this._dialog.busy(false);
                };
            })(this);
            return setTimeout(clearBusy, 1500);
        };

        ImageUploader.prototype._onSave = function () {
            var clearBusy;
            this._dialog.busy(true);
            clearBusy = (function (_this) {
                return function () {
                    _this._dialog.busy(false);
                    return _this._dialog.save(image.url, [image.width, image.height]);
                };
            })(this);
            return setTimeout(clearBusy, 1500);
        };

        ImageUploader.prototype._onUnmount = function () { };

        ImageUploader.createImageUploader = function (dialog) {
            return new ImageUploader(dialog);
        };

        return ImageUploader;

    })();

    window.ImageUploader = ImageUploader;

    window.onload = function () {
        var FIXTURE_TOOLS, IMAGE_FIXTURE_TOOLS, LINK_FIXTURE_TOOLS, editor, req;
        ContentTools.IMAGE_UPLOADER = ImageUploader.createImageUploader;
        ContentTools.StylePalette.add([new ContentTools.Style('By-line', 'article__by-line', ['p']), new ContentTools.Style('Caption', 'article__caption', ['p']), new ContentTools.Style('Example', 'example', ['pre']), new ContentTools.Style('Example + Good', 'example--good', ['pre']), new ContentTools.Style('Example + Bad', 'example--bad', ['pre'])]);
        editor = ContentTools.EditorApp.get();
        editor.init('[data-editable], [data-fixture]', 'data-name');
        editor.addEventListener('saved', function (ev) {
            var name, payload, regions, xhr;

            // Check that something changed
            regions = ev.detail().regions;
            if (Object.keys(regions).length == 0) {
                return;
            }

            // Set the editor as busy while we save our changes
            this.busy(true);

            // Collect the contents of each region into a FormData instance
            payload = new FormData();

            var papa = he.encode(document.querySelector('#test').innerHTML, {
                'encodeEverything': true
            });

            payload.append('dataa', papa);
            payload.append('ayDI',@UrlData[1].ToString());
            // Send the update content to the server to be saved
            function onStateChange(ev) {
                // Check if the request is finished
                if (ev.target.readyState == 4) {
                    editor.busy(false);
                    if (ev.target.status == '200') {
                        // Save was successful, notify the user with a flash
                        new ContentTools.FlashUI('ok');
                    } else {
                        // Save failed, notify the user with a flash
                        new ContentTools.FlashUI('no');
                    }
                }
            };

            xhr = new XMLHttpRequest();
            xhr.addEventListener('readystatechange', onStateChange);
            xhr.open('POST', '../../Backend/upload-content.cshtml');
            xhr.send(payload);
        });
        FIXTURE_TOOLS = [['undo', 'redo', 'remove']];
        IMAGE_FIXTURE_TOOLS = [['undo', 'redo', 'image']];
        LINK_FIXTURE_TOOLS = [['undo', 'redo', 'link']];
        ContentEdit.Root.get().bind('focus', function (element) {
            var tools;
            if (element.isFixed()) {
                if (element.type() === 'ImageFixture') {
                    tools = IMAGE_FIXTURE_TOOLS;
                } else if (element.tagName() === 'a') {
                    tools = LINK_FIXTURE_TOOLS;
                } else {
                    tools = FIXTURE_TOOLS;
                }
            } else {
                tools = ContentTools.DEFAULT_TOOLS;
            }
            if (editor.toolbox().tools() !== tools) {
                return editor.toolbox().tools(tools);
            }
        });
        req = new XMLHttpRequest();
        req.overrideMimeType('application/json');
        req.open('GET', 'https://raw.githubusercontent.com/GetmeUK/ContentTools/master/translations/lp.json', true);
        return req.onreadystatechange = function (ev) {
            var translations;
            if (ev.target.readyState === 4) {
                translations = JSON.parse(ev.target.responseText);
                ContentEdit.addTranslations('lp', translations);
                return ContentEdit.LANGUAGE = 'lp';
            }
        };
    };

}).call(this);
