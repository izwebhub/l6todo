function changePhotoDiv(
    target = "appLogo",
    placeholder = "logo-placeholder",
    width = 250,
    height = 250,
    imgsrc
  ) {
    var fileInput = document.getElementById(target);
    var fileDisplayArea = document.getElementById(placeholder);
  
    if (imgsrc != "") {
      fileDisplayArea.innerHTML = "";
  
      // Create a new image.
      var img = new Image();
      // Set the img src property using the data URL.
      img.width = 250;
      img.height = 250;
      img.src = imgsrc;
  
      // Add the image to the page.
      fileDisplayArea.appendChild(img);
      $(fileDisplayArea).append(
        "<br/><hr/><label class='label label-danger' style='cursor:pointer' id='removeLogo'><i class='fa fa-trash'></i> REMOVE PHOTO</label>"
      );
    }
  
    fileInput.addEventListener("change", function(e) {
      var file = fileInput.files[0];
      var imageType = /image.*/;
  
      if (file.type.match(imageType)) {
        var reader = new FileReader();
  
        reader.onload = function(e) {
          fileDisplayArea.innerHTML = "";
  
          // Create a new image.
          var img = new Image();
          // Set the img src property using the data URL.
          img.width = 250;
          img.height = 250;
          img.src = reader.result;
  
          // Add the image to the page.
          fileDisplayArea.appendChild(img);
          $(fileDisplayArea).append(
            "<br/><hr/><label class='label label-danger' style='cursor:pointer' id='removeLogo'><i class='fa fa-trash'></i> REMOVE PHOTO</label>"
          );
  
          $("body").on("click", "#removeLogo", function() {
            $("#" + placeholder).html("");
            var $el = $("#" + target);
            $el
              .wrap("<form>")
              .closest("form")
              .get(0)
              .reset();
            $el.unwrap();
          });
        };
  
        reader.readAsDataURL(file);
      } else {
        $("#" + placeholder).html("");
        var $el = $("#" + target);
        $el
          .wrap("<form>")
          .closest("form")
          .get(0)
          .reset();
        $el.unwrap();
        fileDisplayArea.innerHTML =
          "<label class='label label-danger'><i class='fa fa-warning'></i> File not supported!</label>";
        fileDisplayArea.style.borderRadius = "4px";
        fileDisplayArea.style.border = "1px solid #ccc";
        fileDisplayArea.style.padding = "2px";
        return false;
      }
    });
  }
  
  function applyOpacity(el, value = 0.2) {
    return $(el).css("opacity", parseFloat(value));
  }
  function removeOpacity(el) {
    $(el).css("opacity", 1);
  }
  
  function imageUploadDisplay(
    imageId,
    imagePlaceholder,
    w = 92,
    h = 92,
    rId = "removeLogo"
  ) {
    var fileInput = document.getElementById(imageId);
    var fileDisplayArea = document.getElementById(imagePlaceholder);
    fileInput.addEventListener("change", function(e) {
      var file = fileInput.files[0];
      var imageType = /image.*/;
  
      if (file.type.match(imageType)) {
        var reader = new FileReader();
  
        reader.onload = function(e) {
          fileDisplayArea.innerHTML = "";
  
          // Create a new image.
          var img = new Image();
          // Set the img src property using the data URL.
          img.width = w;
          img.height = h;
          img.src = reader.result;
  
          // Add the image to the page.
          fileDisplayArea.appendChild(img);
          $(fileDisplayArea).append(
            "<br/><hr/><label class='label label-danger' style='cursor:pointer' id=rId><i class='fa fa-trash'></i> REMOVE PHOTO</label>"
          );
          $("body").on("click", "#" + rId, function() {
            $("#" + imagePlaceholder).html("");
            var $el = $("#" + imageId);
            $el
              .wrap("<form>")
              .closest("form")
              .get(0)
              .reset();
            $el.unwrap();
          });
        };
  
        reader.readAsDataURL(file);
      } else {
        $("#" + imagePlaceholder).html("");
        var $el = $("#" + imageId);
        $el
          .wrap("<form>")
          .closest("form")
          .get(0)
          .reset();
        $el.unwrap();
        fileDisplayArea.innerHTML =
          "<label class='label label-danger'><i class='fa fa-warning'></i> File not supported!</label>";
        fileDisplayArea.style.borderRadius = "4px";
        fileDisplayArea.style.border = "1px solid #ccc";
        fileDisplayArea.style.padding = "2px";
        return false;
      }
    });
  }
  
  function getParent(el, level = 1) {
    if (parseInt(level) == 1) {
      return $(el).parent();
    } else if (parseInt(level) == 2) {
      return $(el)
        .parent()
        .parent();
    } else if (parseInt(level) == 3) {
      return $(el)
        .parent()
        .parent()
        .parent();
    }
  }
  
  function serializeData(el) {
    return $(el).serializeArray();
  }
  
  function prepareFormData(arr, arr2) {
    var form_data = new FormData();
    $.each(arr, function(i, k) {
      form_data.append(k.name, k.value);
    });
    $.each(arr2, function(i, k) {
      var a = $("#" + k).prop("files")[0];
      form_data.append(k, a);
    });
    return form_data;
  }
  
  function getAllFormData(el) {
    return $(el).serializeArray();
  }
  
  function showFeedBack(el, str, error = true, url = null) {
    if (url != null) {
      if (!error) {
        var newDiv = $("<div style='margin: 5px' />")
          .addClass("alert alert-success flush")
          .html('<h5><i class="fa fa-check-circle"></i> ' + str + "</h5>")
          .delay(8000)
          .fadeOut("normal", function() {
            window.location = url;
          });
      } else {
        var newDiv = $("<div/>")
          .addClass("alert alert-danger flush")
          .html('<h5><i class="fa fa-close"></i> ' + str + "</h5>")
          .delay(8000)
          .fadeOut("normal", function() {
            window.location = url;
          });
      }
      $(el).before(newDiv);
    } else {
      if (!error) {
        var newDiv = $("<div/>")
          .addClass("alert alert-success flush")
          .html('<h5><i class="fa fa-check-circle"></i> ' + str + "</h5>")
          .delay(8000)
          .fadeOut();
      } else {
        var newDiv = $("<div/>")
          .addClass("alert alert-danger flush")
          .html('<h5><i class="fa fa-close"></i> ' + str + "</h5>")
          .delay(8000)
          .fadeOut();
      }
      $(el).before(newDiv);
    }
  }
  
  function isFileValueSetted(file) {
    return $(file).prop("files")[0];
  }
  
  function logIt(str) {
    if (this.debug) {
      console.log(str);
    }
  }
  
  function confirmDialog(str, native = true) {
    if (native) {
      var cf = confirm(str);
      if (cf) {
        return true;
      } else {
        return false;
      }
    }
  }
  
  function unSet(el) {
    $(el).val("");
  }
  
  function getProp(el, key) {
    return $(el).attr(key);
  }
  
  function parseData(jsn) {
    return JSON.parse(jsn);
  }
  
  function refreshViewFromServer(view, url) {
    $.get(url, function(res) {
      $("#" + view).html(res);
    });
  }
  
  function talkToServer(
    url,
    data,
    isFileUpload = false,
    method = "post",
    dataType = "text",
    el = null,
    type = "post"
  ) {
    if (isFileUpload) {
      var promise = $.ajax({
        url: url,
        dataType: dataType,
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: type,
        xhr: function() {
          var xhr = $.ajaxSettings.xhr();
          xhr.upload.onprogress = function(e) {
            var ps = Math.floor((e.loaded / e.total) * 100) + "%";
            if (el != null) {
              $(el).html(ps);
            }
          };
          return xhr;
        }
      });
      return promise;
    } else {
      if (method == "post") {
        var p = $.post(url, data);
        return p;
      } else {
        var g = $.get(url, data);
        return g;
      }
    }
  }
  
  var Biggo = {
    debug: false,
    edit: false,
    applyOpacity: applyOpacity,
    removeOpacity: removeOpacity,
    getAllFormData: getAllFormData,
    showFeedBack: showFeedBack,
    logIt: logIt,
    talkToServer: talkToServer,
    parseData: parseData,
    unSet: unSet,
    refreshViewFromServer: refreshViewFromServer,
    getProp: getProp,
    confirmDialog: confirmDialog,
    getParent: getParent,
    prepareFormData: prepareFormData,
    serializeData: serializeData,
    isFileValueSetted: isFileValueSetted,
    imageUploadDisplay: imageUploadDisplay,
    changePhotoDiv: changePhotoDiv
  };
  