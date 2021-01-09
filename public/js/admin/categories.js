/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/categories.js":
/*!******************************************!*\
  !*** ./resources/js/admin/categories.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Category = /*#__PURE__*/function () {
  function Category() {
    _classCallCheck(this, Category);

    this.table = document.querySelector("tbody");
    this.confirmDeleteBtn = document.getElementById("confirmDelete");
    this.deleteCategoryModalElement = document.getElementById("deleteCategoryModal");
    this.editCategoryModalElement = document.getElementById("editCategoryModal");
    this.deleteCategoryModal = new mdb.Modal(this.deleteCategoryModalElement);
    this.editCategoryModal = new mdb.Modal(this.editCategoryModalElement);
    this.editCategoryModalContent = document.getElementById("editCategoryModalContent");
    this.oldEditCategoryModalContent = this.editCategoryModalContent.cloneNode(true);
    this.tableListener();
    this.modalHideListener();
  }

  _createClass(Category, [{
    key: "tableListener",
    value: function tableListener() {
      var _this = this;

      this.table.addEventListener("click", function (event) {
        actionButton = event.target.closest("button");

        if (actionButton.id === "deleteCategory") {
          categoryId = actionButton.dataset.categoryId;

          _this.deleteListener(categoryId);
        }

        if (actionButton.id === "editCategory") {
          categoryId = actionButton.dataset.categoryId;

          _this.performEdit(categoryId);
        }
      });
    }
  }, {
    key: "modalHideListener",
    value: function modalHideListener() {
      this.editCategoryModalElement.addEventListener("hide.mdb.modal", this.clearEditModal.bind(this));
      this.deleteCategoryModalElement.addEventListener("hide.mdb.modal", this.clearDeleteListener.bind(this));
    }
  }, {
    key: "deleteListener",
    value: function deleteListener(categoryId) {
      this.confirmDeleteBtn.addEventListener("click", this.performDelete.bind(this, categoryId));
    }
  }, {
    key: "performDelete",
    value: function performDelete(categoryId) {
      var _this2 = this;

      window.axios["delete"]("/admin/categories/".concat(categoryId)).then(function (response) {
        _this2.clearDeleteListener();

        location.reload();
      })["catch"](function (error) {
        _this2.deleteCategoryModal.hide();

        alert("Something went wrong!");
      });
    }
  }, {
    key: "performEdit",
    value: function performEdit(categoryId) {
      var _this3 = this;

      window.axios.get("/admin/categories/".concat(categoryId)).then(function (response) {
        _this3.editCategoryModalContent.innerHTML = response.data;

        _this3.initializeInput();
      })["catch"](function (error) {
        _this3.editCategoryModalContent.innerHTML = '<div class="text-center p-5><h3 class="text-danger">Something went wrong</h3></div>';
      });
    }
  }, {
    key: "initializeInput",
    value: function initializeInput() {
      this.editCategoryModalContent.querySelectorAll(".form-outline").forEach(function (formOutline) {
        new mdb.Input(formOutline).init();
      });
    }
  }, {
    key: "clearDeleteListener",
    value: function clearDeleteListener() {
      // this.confirmDeleteBtn.removeEventListener(
      //     "click",
      //     this.performDelete.bind(null, categoryId)
      // );
      this.confirmDeleteBtn = this.confirmDeleteBtn.cloneNode(true);
    }
  }, {
    key: "clearEditModal",
    value: function clearEditModal() {
      this.editCategoryModalContent = this.oldEditCategoryModalContent.cloneNode(true);
    }
  }]);

  return Category;
}();

new Category();

/***/ }),

/***/ 3:
/*!************************************************!*\
  !*** multi ./resources/js/admin/categories.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/olshop/resources/js/admin/categories.js */"./resources/js/admin/categories.js");


/***/ })

/******/ });