/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@babel/runtime/regenerator/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/@babel/runtime/regenerator/index.js ***!
  \**********************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__(/*! regenerator-runtime */ "./node_modules/regenerator-runtime/runtime.js");


/***/ }),

/***/ "./resources/js/dinway/components/faq/faq-categories-list.js":
/*!*******************************************************************!*\
  !*** ./resources/js/dinway/components/faq/faq-categories-list.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _store_questions_items__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../store/questions-items */ "./resources/js/dinway/store/questions-items/index.js");
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./helpers */ "./resources/js/dinway/components/faq/helpers.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



var wrapper = document.querySelector("#faq-questions-list");

if (wrapper) {
  _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
    var categories;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return (0,_store_questions_items__WEBPACK_IMPORTED_MODULE_1__.getCategories)();

          case 2:
            categories = _context.sent;
            (0,_helpers__WEBPACK_IMPORTED_MODULE_2__.generateQuestionsList)(categories, wrapper);

          case 4:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }))();
}

/***/ }),

/***/ "./resources/js/dinway/components/faq/faq-questions.js":
/*!*************************************************************!*\
  !*** ./resources/js/dinway/components/faq/faq-questions.js ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _store_questions_items__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../store/questions-items */ "./resources/js/dinway/store/questions-items/index.js");
/* harmony import */ var _helpers_questions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../helpers/questions */ "./resources/js/dinway/helpers/questions.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



window.addEventListener("DOMContentLoaded", function () {
  var faqQuestions = document.querySelector(".faq-questions");

  if (faqQuestions) {
    _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
      var getPaginationBullets, generateListForPhone, initPagination, insertQuestions, categories, questionsItems, menu, wrapper, pagination, qCount, choice;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              insertQuestions = function _insertQuestions(wrapper, questionsArray, start, end) {
                var questions = (0,_helpers_questions__WEBPACK_IMPORTED_MODULE_2__.getQuestions)(questionsArray, start, end);
                wrapper.innerHTML = "";
                questions.forEach(function (question) {
                  return wrapper.insertAdjacentHTML("beforeend", question);
                });
              };

              initPagination = function _initPagination(items, category) {
                var part = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 10;
                var bullets = getPaginationBullets(items[category], part);

                if (bullets.length > 1) {
                  faqQuestions.querySelector(".questions-pagination").innerHTML = bullets.join("");
                }

                pagination.setAttribute("data-category", category);
              };

              generateListForPhone = function _generateListForPhone() {
                var list = document.querySelector(".faq-questions-list");
                var aside = document.querySelector(".faq-questions__aside");

                if (window.innerWidth < 768) {
                  choice.insertAdjacentElement("beforeend", list);
                } else {
                  aside.insertAdjacentElement("beforeend", list);
                }
              };

              getPaginationBullets = function _getPaginationBullets(items, part) {
                var bulets = [];

                for (var i = 0, j = 1; i < items.length; i += part) {
                  var span = "<span class=\"questions-pagination-bulet\" data-start=\"".concat(i, "\">").concat(j++, "</span>");
                  bulets.push(span);
                }

                bulets[0] = "<span class=\"questions-pagination-bulet active\" data-start=\"0\">1</span>";
                return bulets;
              };

              _context.next = 6;
              return (0,_store_questions_items__WEBPACK_IMPORTED_MODULE_1__.getCategories)();

            case 6:
              categories = _context.sent;
              _context.next = 9;
              return (0,_store_questions_items__WEBPACK_IMPORTED_MODULE_1__.getQuestionsItems)();

            case 9:
              questionsItems = _context.sent;
              menu = faqQuestions.querySelector(".faq-questions-list");
              wrapper = faqQuestions.querySelector(".questions");
              pagination = faqQuestions.querySelector(".questions-pagination");
              qCount = 10;
              choice = document.querySelector(".faq-questions-choice");
              choice.addEventListener("click", function (e) {
                var target = e.target;
                var name = choice.querySelector("[data-list-name]");
                var qItem = target.closest(".faq-questions-list__item");

                if (choice.hasAttribute("data-question") || qItem) {
                  name.textContent = target.textContent;
                }

                choice.classList.toggle("active");
              });
              initPagination(questionsItems, categories[0]);
              (0,_helpers_questions__WEBPACK_IMPORTED_MODULE_2__.questionOnClick)(document.querySelector(".faq-page"));
              insertQuestions(wrapper, questionsItems[categories[0]], 0, qCount);
              generateListForPhone();
              window.addEventListener("resize", generateListForPhone);
              menu.addEventListener("click", function (e) {
                var target = e.target;

                if (target != menu) {
                  var btn = (target.hasAttribute("data-question") ? target : false) || target.querySelector("[data-question]");

                  if (btn) {
                    var category = btn.dataset.question;
                    var item = btn.closest(".faq-questions-list__item");
                    menu.querySelectorAll(".faq-questions-list__item").forEach(function (item) {
                      if (item.classList.contains("faq-questions-list__item--current")) item.classList.remove("faq-questions-list__item--current");
                    });
                    item.classList.add("faq-questions-list__item--current");
                    insertQuestions(wrapper, questionsItems[category], 0, qCount);
                    initPagination(questionsItems, category, qCount);
                  }
                }
              });
              pagination.addEventListener("click", function (e) {
                var index = parseInt(e.target.dataset.start);
                var target = e.target;
                var btn = target.hasAttribute("data-start") ? target : target.querySelector("[data-start]");

                if (btn) {
                  var start = parseInt(btn.dataset.start);
                  var category = btn.closest(".questions-pagination").dataset.category;
                  insertQuestions(wrapper, questionsItems[category], start, start + qCount);
                  initPagination(questionsItems, category, qCount);
                  var items = pagination.querySelectorAll(".questions-pagination-bulet");
                  items.forEach(function (item) {
                    if (item.classList.contains("active") && item.dataset.start != index) {
                      item.classList.remove("active");
                    } else if (item.dataset.start == index) {
                      item.classList.add("active");
                    }
                  });
                }
              });

            case 23:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }))();
  }
});

/***/ }),

/***/ "./resources/js/dinway/components/faq/faq-search.js":
/*!**********************************************************!*\
  !*** ./resources/js/dinway/components/faq/faq-search.js ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _helpers_questions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../helpers/questions */ "./resources/js/dinway/helpers/questions.js");
/* harmony import */ var _store_questions_items__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../store/questions-items */ "./resources/js/dinway/store/questions-items/index.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



window.addEventListener('DOMContentLoaded', function () {
  // search 
  var faqQuestionsSection = document.querySelector('.faq-page');

  if (faqQuestionsSection) {
    var search = faqQuestionsSection.querySelector('.search__input');
    var contentContainer = faqQuestionsSection.querySelector('.faq-questions__content');
    var faqSearchResult = faqQuestionsSection.querySelector('.faq-search-result');
    search.addEventListener('input', function () {
      var text = this.value.trim().toLowerCase();

      if (text !== '') {
        _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
          var questionsItems, questions, questionsHTML;
          return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
            while (1) {
              switch (_context.prev = _context.next) {
                case 0:
                  _context.next = 2;
                  return (0,_store_questions_items__WEBPACK_IMPORTED_MODULE_2__.getQuestionsItems)();

                case 2:
                  questionsItems = _context.sent;
                  questions = (0,_helpers_questions__WEBPACK_IMPORTED_MODULE_1__.findQuestions)(questionsItems, text);
                  questionsHTML = questions.join('') || trans('dinway.faq-search.not-found');
                  contentContainer.classList.add('active');
                  faqSearchResult.classList.add('active');
                  faqSearchResult.innerHTML = "<div class=\"questions__items\">".concat(questionsHTML, "<button class=\"faq-search-result__btn btn-blue\">").concat(trans('dinway.faq-search.btn-cancel'), "</button></div>");

                case 8:
                case "end":
                  return _context.stop();
              }
            }
          }, _callee);
        }))();
      } else {
        faqSearchResult.innerHTML = '';
        contentContainer.classList.remove('active');
        faqSearchResult.classList.remove('active');
      }
    });
    faqQuestionsSection.addEventListener('click', function (e) {
      if (e.target.closest('.faq-search-result__btn')) {
        search.value = '';
        faqSearchResult.innerHTML = '';
        contentContainer.classList.remove('active');
        faqSearchResult.classList.remove('active');
      }
    });
  }
});

/***/ }),

/***/ "./resources/js/dinway/components/faq/faq.js":
/*!***************************************************!*\
  !*** ./resources/js/dinway/components/faq/faq.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _store_questions_items__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../store/questions-items */ "./resources/js/dinway/store/questions-items/index.js");
/* harmony import */ var _helpers_questions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../helpers/questions */ "./resources/js/dinway/helpers/questions.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



!function () {
  var faq = document.querySelector(".faq");

  if (faq) {
    _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
      var questionsItems, categories, categoryIndex, categoryArray, category, wrapper, questionsSettings;
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              _context.next = 2;
              return (0,_store_questions_items__WEBPACK_IMPORTED_MODULE_1__.getQuestionsItems)();

            case 2:
              questionsItems = _context.sent;
              _context.next = 5;
              return (0,_store_questions_items__WEBPACK_IMPORTED_MODULE_1__.getCategories)();

            case 5:
              categories = _context.sent;
              categoryIndex = 0;

              if (window.faqQuestionCategory) {
                categoryArray = window.faqQuestionCategory.split(',');
                category = '';
                categoryArray.forEach(function (name) {
                  if (categories.indexOf(name) > -1) {
                    category = name;
                  }
                });
                categoryIndex = categories.indexOf(category);
                categoryIndex == -1 ? categoryIndex = 0 : 1;
              }

              wrapper = document.querySelector(".questions");
              questionsSettings = {
                wrapper: wrapper,
                questionsItems: questionsItems[categories[categoryIndex]],
                countOnPhone: 7,
                countOnDesktop: 7
              };
              (0,_helpers_questions__WEBPACK_IMPORTED_MODULE_2__.generateQuestions)(questionsSettings);
              window.addEventListener("resize", (0,_helpers_questions__WEBPACK_IMPORTED_MODULE_2__.generateQuestions)(questionsSettings));
              (0,_helpers_questions__WEBPACK_IMPORTED_MODULE_2__.questionOnClick)(wrapper);

            case 13:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }))();
  }
}();

/***/ }),

/***/ "./resources/js/dinway/components/faq/helpers.js":
/*!*******************************************************!*\
  !*** ./resources/js/dinway/components/faq/helpers.js ***!
  \*******************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "generateQuestionsList": () => (/* binding */ generateQuestionsList)
/* harmony export */ });
function createQuestionsListItem(category) {
  var current = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var className = current ? 'faq-questions-list__item faq-questions-list__item--current' : 'faq-questions-list__item';
  return "<li class=\"".concat(className, "\">\n        <button class=\"faq-questions-list__link\" data-question=\"").concat(category, "\">").concat(category, "</button>\n    </li>");
}

function generateQuestionsList(categories, wrapper) {
  var QuestionsListItems = categories.map(function (category, index) {
    return createQuestionsListItem(category, !index);
  });
  wrapper.insertAdjacentHTML('afterbegin', QuestionsListItems.join(''));
}

/***/ }),

/***/ "./resources/js/dinway/components/faq/index.js":
/*!*****************************************************!*\
  !*** ./resources/js/dinway/components/faq/index.js ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _faq__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./faq */ "./resources/js/dinway/components/faq/faq.js");
/* harmony import */ var _faq_questions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./faq-questions */ "./resources/js/dinway/components/faq/faq-questions.js");
/* harmony import */ var _faq_categories_list__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./faq-categories-list */ "./resources/js/dinway/components/faq/faq-categories-list.js");
/* harmony import */ var _faq_search__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./faq-search */ "./resources/js/dinway/components/faq/faq-search.js");
 // it's block at page

 // it's page faq


 // it's search at page faq

/***/ }),

/***/ "./resources/js/dinway/helpers/data.js":
/*!*********************************************!*\
  !*** ./resources/js/dinway/helpers/data.js ***!
  \*********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getResponceJson": () => (/* binding */ getResponceJson)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function getResponceJson(_x) {
  return _getResponceJson.apply(this, arguments);
}

function _getResponceJson() {
  _getResponceJson = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee(url) {
    var response, json;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return fetch(url);

          case 2:
            response = _context.sent;

            if (!response.ok) {
              _context.next = 10;
              break;
            }

            _context.next = 6;
            return response.json();

          case 6:
            json = _context.sent;
            return _context.abrupt("return", json);

          case 10:
            console.log("Ошибка HTTP: " + response.status);

          case 11:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));
  return _getResponceJson.apply(this, arguments);
}

/***/ }),

/***/ "./resources/js/dinway/helpers/questions.js":
/*!**************************************************!*\
  !*** ./resources/js/dinway/helpers/questions.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "createQuestion": () => (/* binding */ createQuestion),
/* harmony export */   "removeQuestions": () => (/* binding */ removeQuestions),
/* harmony export */   "getQuestions": () => (/* binding */ getQuestions),
/* harmony export */   "generateQuestions": () => (/* binding */ generateQuestions),
/* harmony export */   "questionOnClick": () => (/* binding */ questionOnClick),
/* harmony export */   "findQuestions": () => (/* binding */ findQuestions)
/* harmony export */ });
function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function createQuestion(questionText, answerText) {
  return "\n    <div class=\"questions__item\" data-aos=\"fade-up\">\n        <div class=\"question\">\n            <p class=\"question__text\">".concat(questionText, "</p>\n            <svg class=\"question__arrow\" width=\"13\" height=\"9\" viewBox=\"0 0 13 9\"  xmlns=\"http://www.w3.org/2000/svg\">\n                <path d=\"M7.90691 7.60752C7.12756 8.37888 5.87244 8.37888 5.0931 7.60753L0.863676 3.42149C-0.406267 2.16457 0.483796 0 2.27058 0H10.7294C12.5162 0 13.4063 2.16457 12.1363 3.42148L7.90691 7.60752Z\" fill=\"#001032\"/>\n            </svg>\n        </div>\n        <div class=\"answer\">\n            <div class=\"answer__container\">").concat(answerText, "</div>\n        </div>\n    </div>");
}
function removeQuestions(wrapper) {
  var items = wrapper.querySelectorAll('.questions__item');
  items.forEach(function (item) {
    return item.remove();
  });
} // возвращает вопросы со startPosition (по умолчанию 0) до endPosition, не включая endPosition (по умолчанию null)

function getQuestions(questionsArray, startPosition, endPosition) {
  var _startPosition, _endPosition;

  startPosition = (_startPosition = startPosition) !== null && _startPosition !== void 0 ? _startPosition : 0;
  endPosition = (_endPosition = endPosition) !== null && _endPosition !== void 0 ? _endPosition : questionsArray.length;
  var items = questionsArray.slice(startPosition, endPosition);
  var questions = [];
  items.forEach(function (item) {
    questions.push(createQuestion(item.question, item.answer));
  });
  return questions;
}
function generateQuestions(settings) {
  var wrapper = settings.wrapper,
      questionsItems = settings.questionsItems,
      _settings$phoneWidth = settings.phoneWidth,
      phoneWidth = _settings$phoneWidth === void 0 ? 576 : _settings$phoneWidth,
      _settings$countOnPhon = settings.countOnPhone,
      countOnPhone = _settings$countOnPhon === void 0 ? 7 : _settings$countOnPhon,
      _settings$countOnDesk = settings.countOnDesktop,
      countOnDesktop = _settings$countOnDesk === void 0 ? 7 : _settings$countOnDesk;
  removeQuestions(wrapper);
  var questions = getQuestions(questionsItems);

  if (window.innerWidth <= phoneWidth) {
    for (var i = 0; i < countOnPhone && i < questions.length; i++) {
      wrapper.insertAdjacentHTML('beforeend', questions[i]);
    }
  } else {
    for (var _i = 0; _i < countOnDesktop && _i < questions.length; _i++) {
      wrapper.insertAdjacentHTML('beforeend', questions[_i]);
    }
  }
}
function questionOnClick(wrapper) {
  wrapper.addEventListener('click', function (e) {
    var question = e.target.closest('.question');

    if (question) {
      var questionItem = question.closest('.questions__item');
      var answer = questionItem.querySelector('.answer');
      var height = answer.querySelector('.answer__container').offsetHeight + 'px';

      if (questionItem.classList.contains('active')) {
        answer.style.height = 0;
        questionItem.classList.remove('active');
      } else {
        answer.style.height = height;
        questionItem.classList.add('active');
      }
    }
  });
}
function findQuestions(questionsObject, textTitle) {
  if (!textTitle) {
    return false;
  }

  var words = textTitle.split(' ');
  var results = [];

  var _loop = function _loop(key) {
    var array = questionsObject[key];
    words.forEach(function (word) {
      var _iterator = _createForOfIteratorHelper(array),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var v = _step.value;

          if (v.question.toLowerCase().includes(word)) {
            results.push(createQuestion(v.question, v.answer));
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    });
  };

  for (var key in questionsObject) {
    _loop(key);
  }

  return results;
}

/***/ }),

/***/ "./resources/js/dinway/store/questions-items/index.js":
/*!************************************************************!*\
  !*** ./resources/js/dinway/store/questions-items/index.js ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getQuestionsItems": () => (/* binding */ getQuestionsItems),
/* harmony export */   "getCategories": () => (/* binding */ getCategories)
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _helpers_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../helpers/data */ "./resources/js/dinway/helpers/data.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


function getQuestionsItems() {
  return _getQuestionsItems.apply(this, arguments);
}

function _getQuestionsItems() {
  _getQuestionsItems = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
      while (1) {
        switch (_context.prev = _context.next) {
          case 0:
            _context.next = 2;
            return (0,_helpers_data__WEBPACK_IMPORTED_MODULE_1__.getResponceJson)('/faq/data');

          case 2:
            return _context.abrupt("return", _context.sent);

          case 3:
          case "end":
            return _context.stop();
        }
      }
    }, _callee);
  }));
  return _getQuestionsItems.apply(this, arguments);
}

function getCategories() {
  return _getCategories.apply(this, arguments);
}

function _getCategories() {
  _getCategories = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
    var questionsItems;
    return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
      while (1) {
        switch (_context2.prev = _context2.next) {
          case 0:
            _context2.next = 2;
            return getQuestionsItems();

          case 2:
            questionsItems = _context2.sent;
            return _context2.abrupt("return", Object.keys(questionsItems));

          case 4:
          case "end":
            return _context2.stop();
        }
      }
    }, _callee2);
  }));
  return _getCategories.apply(this, arguments);
}

/***/ }),

/***/ "./node_modules/regenerator-runtime/runtime.js":
/*!*****************************************************!*\
  !*** ./node_modules/regenerator-runtime/runtime.js ***!
  \*****************************************************/
/***/ ((module) => {

/**
 * Copyright (c) 2014-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var runtime = (function (exports) {
  "use strict";

  var Op = Object.prototype;
  var hasOwn = Op.hasOwnProperty;
  var undefined; // More compressible than void 0.
  var $Symbol = typeof Symbol === "function" ? Symbol : {};
  var iteratorSymbol = $Symbol.iterator || "@@iterator";
  var asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator";
  var toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag";

  function define(obj, key, value) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
    return obj[key];
  }
  try {
    // IE 8 has a broken Object.defineProperty that only works on DOM objects.
    define({}, "");
  } catch (err) {
    define = function(obj, key, value) {
      return obj[key] = value;
    };
  }

  function wrap(innerFn, outerFn, self, tryLocsList) {
    // If outerFn provided and outerFn.prototype is a Generator, then outerFn.prototype instanceof Generator.
    var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator;
    var generator = Object.create(protoGenerator.prototype);
    var context = new Context(tryLocsList || []);

    // The ._invoke method unifies the implementations of the .next,
    // .throw, and .return methods.
    generator._invoke = makeInvokeMethod(innerFn, self, context);

    return generator;
  }
  exports.wrap = wrap;

  // Try/catch helper to minimize deoptimizations. Returns a completion
  // record like context.tryEntries[i].completion. This interface could
  // have been (and was previously) designed to take a closure to be
  // invoked without arguments, but in all the cases we care about we
  // already have an existing method we want to call, so there's no need
  // to create a new function object. We can even get away with assuming
  // the method takes exactly one argument, since that happens to be true
  // in every case, so we don't have to touch the arguments object. The
  // only additional allocation required is the completion record, which
  // has a stable shape and so hopefully should be cheap to allocate.
  function tryCatch(fn, obj, arg) {
    try {
      return { type: "normal", arg: fn.call(obj, arg) };
    } catch (err) {
      return { type: "throw", arg: err };
    }
  }

  var GenStateSuspendedStart = "suspendedStart";
  var GenStateSuspendedYield = "suspendedYield";
  var GenStateExecuting = "executing";
  var GenStateCompleted = "completed";

  // Returning this object from the innerFn has the same effect as
  // breaking out of the dispatch switch statement.
  var ContinueSentinel = {};

  // Dummy constructor functions that we use as the .constructor and
  // .constructor.prototype properties for functions that return Generator
  // objects. For full spec compliance, you may wish to configure your
  // minifier not to mangle the names of these two functions.
  function Generator() {}
  function GeneratorFunction() {}
  function GeneratorFunctionPrototype() {}

  // This is a polyfill for %IteratorPrototype% for environments that
  // don't natively support it.
  var IteratorPrototype = {};
  IteratorPrototype[iteratorSymbol] = function () {
    return this;
  };

  var getProto = Object.getPrototypeOf;
  var NativeIteratorPrototype = getProto && getProto(getProto(values([])));
  if (NativeIteratorPrototype &&
      NativeIteratorPrototype !== Op &&
      hasOwn.call(NativeIteratorPrototype, iteratorSymbol)) {
    // This environment has a native %IteratorPrototype%; use it instead
    // of the polyfill.
    IteratorPrototype = NativeIteratorPrototype;
  }

  var Gp = GeneratorFunctionPrototype.prototype =
    Generator.prototype = Object.create(IteratorPrototype);
  GeneratorFunction.prototype = Gp.constructor = GeneratorFunctionPrototype;
  GeneratorFunctionPrototype.constructor = GeneratorFunction;
  GeneratorFunction.displayName = define(
    GeneratorFunctionPrototype,
    toStringTagSymbol,
    "GeneratorFunction"
  );

  // Helper for defining the .next, .throw, and .return methods of the
  // Iterator interface in terms of a single ._invoke method.
  function defineIteratorMethods(prototype) {
    ["next", "throw", "return"].forEach(function(method) {
      define(prototype, method, function(arg) {
        return this._invoke(method, arg);
      });
    });
  }

  exports.isGeneratorFunction = function(genFun) {
    var ctor = typeof genFun === "function" && genFun.constructor;
    return ctor
      ? ctor === GeneratorFunction ||
        // For the native GeneratorFunction constructor, the best we can
        // do is to check its .name property.
        (ctor.displayName || ctor.name) === "GeneratorFunction"
      : false;
  };

  exports.mark = function(genFun) {
    if (Object.setPrototypeOf) {
      Object.setPrototypeOf(genFun, GeneratorFunctionPrototype);
    } else {
      genFun.__proto__ = GeneratorFunctionPrototype;
      define(genFun, toStringTagSymbol, "GeneratorFunction");
    }
    genFun.prototype = Object.create(Gp);
    return genFun;
  };

  // Within the body of any async function, `await x` is transformed to
  // `yield regeneratorRuntime.awrap(x)`, so that the runtime can test
  // `hasOwn.call(value, "__await")` to determine if the yielded value is
  // meant to be awaited.
  exports.awrap = function(arg) {
    return { __await: arg };
  };

  function AsyncIterator(generator, PromiseImpl) {
    function invoke(method, arg, resolve, reject) {
      var record = tryCatch(generator[method], generator, arg);
      if (record.type === "throw") {
        reject(record.arg);
      } else {
        var result = record.arg;
        var value = result.value;
        if (value &&
            typeof value === "object" &&
            hasOwn.call(value, "__await")) {
          return PromiseImpl.resolve(value.__await).then(function(value) {
            invoke("next", value, resolve, reject);
          }, function(err) {
            invoke("throw", err, resolve, reject);
          });
        }

        return PromiseImpl.resolve(value).then(function(unwrapped) {
          // When a yielded Promise is resolved, its final value becomes
          // the .value of the Promise<{value,done}> result for the
          // current iteration.
          result.value = unwrapped;
          resolve(result);
        }, function(error) {
          // If a rejected Promise was yielded, throw the rejection back
          // into the async generator function so it can be handled there.
          return invoke("throw", error, resolve, reject);
        });
      }
    }

    var previousPromise;

    function enqueue(method, arg) {
      function callInvokeWithMethodAndArg() {
        return new PromiseImpl(function(resolve, reject) {
          invoke(method, arg, resolve, reject);
        });
      }

      return previousPromise =
        // If enqueue has been called before, then we want to wait until
        // all previous Promises have been resolved before calling invoke,
        // so that results are always delivered in the correct order. If
        // enqueue has not been called before, then it is important to
        // call invoke immediately, without waiting on a callback to fire,
        // so that the async generator function has the opportunity to do
        // any necessary setup in a predictable way. This predictability
        // is why the Promise constructor synchronously invokes its
        // executor callback, and why async functions synchronously
        // execute code before the first await. Since we implement simple
        // async functions in terms of async generators, it is especially
        // important to get this right, even though it requires care.
        previousPromise ? previousPromise.then(
          callInvokeWithMethodAndArg,
          // Avoid propagating failures to Promises returned by later
          // invocations of the iterator.
          callInvokeWithMethodAndArg
        ) : callInvokeWithMethodAndArg();
    }

    // Define the unified helper method that is used to implement .next,
    // .throw, and .return (see defineIteratorMethods).
    this._invoke = enqueue;
  }

  defineIteratorMethods(AsyncIterator.prototype);
  AsyncIterator.prototype[asyncIteratorSymbol] = function () {
    return this;
  };
  exports.AsyncIterator = AsyncIterator;

  // Note that simple async functions are implemented on top of
  // AsyncIterator objects; they just return a Promise for the value of
  // the final result produced by the iterator.
  exports.async = function(innerFn, outerFn, self, tryLocsList, PromiseImpl) {
    if (PromiseImpl === void 0) PromiseImpl = Promise;

    var iter = new AsyncIterator(
      wrap(innerFn, outerFn, self, tryLocsList),
      PromiseImpl
    );

    return exports.isGeneratorFunction(outerFn)
      ? iter // If outerFn is a generator, return the full iterator.
      : iter.next().then(function(result) {
          return result.done ? result.value : iter.next();
        });
  };

  function makeInvokeMethod(innerFn, self, context) {
    var state = GenStateSuspendedStart;

    return function invoke(method, arg) {
      if (state === GenStateExecuting) {
        throw new Error("Generator is already running");
      }

      if (state === GenStateCompleted) {
        if (method === "throw") {
          throw arg;
        }

        // Be forgiving, per 25.3.3.3.3 of the spec:
        // https://people.mozilla.org/~jorendorff/es6-draft.html#sec-generatorresume
        return doneResult();
      }

      context.method = method;
      context.arg = arg;

      while (true) {
        var delegate = context.delegate;
        if (delegate) {
          var delegateResult = maybeInvokeDelegate(delegate, context);
          if (delegateResult) {
            if (delegateResult === ContinueSentinel) continue;
            return delegateResult;
          }
        }

        if (context.method === "next") {
          // Setting context._sent for legacy support of Babel's
          // function.sent implementation.
          context.sent = context._sent = context.arg;

        } else if (context.method === "throw") {
          if (state === GenStateSuspendedStart) {
            state = GenStateCompleted;
            throw context.arg;
          }

          context.dispatchException(context.arg);

        } else if (context.method === "return") {
          context.abrupt("return", context.arg);
        }

        state = GenStateExecuting;

        var record = tryCatch(innerFn, self, context);
        if (record.type === "normal") {
          // If an exception is thrown from innerFn, we leave state ===
          // GenStateExecuting and loop back for another invocation.
          state = context.done
            ? GenStateCompleted
            : GenStateSuspendedYield;

          if (record.arg === ContinueSentinel) {
            continue;
          }

          return {
            value: record.arg,
            done: context.done
          };

        } else if (record.type === "throw") {
          state = GenStateCompleted;
          // Dispatch the exception by looping back around to the
          // context.dispatchException(context.arg) call above.
          context.method = "throw";
          context.arg = record.arg;
        }
      }
    };
  }

  // Call delegate.iterator[context.method](context.arg) and handle the
  // result, either by returning a { value, done } result from the
  // delegate iterator, or by modifying context.method and context.arg,
  // setting context.delegate to null, and returning the ContinueSentinel.
  function maybeInvokeDelegate(delegate, context) {
    var method = delegate.iterator[context.method];
    if (method === undefined) {
      // A .throw or .return when the delegate iterator has no .throw
      // method always terminates the yield* loop.
      context.delegate = null;

      if (context.method === "throw") {
        // Note: ["return"] must be used for ES3 parsing compatibility.
        if (delegate.iterator["return"]) {
          // If the delegate iterator has a return method, give it a
          // chance to clean up.
          context.method = "return";
          context.arg = undefined;
          maybeInvokeDelegate(delegate, context);

          if (context.method === "throw") {
            // If maybeInvokeDelegate(context) changed context.method from
            // "return" to "throw", let that override the TypeError below.
            return ContinueSentinel;
          }
        }

        context.method = "throw";
        context.arg = new TypeError(
          "The iterator does not provide a 'throw' method");
      }

      return ContinueSentinel;
    }

    var record = tryCatch(method, delegate.iterator, context.arg);

    if (record.type === "throw") {
      context.method = "throw";
      context.arg = record.arg;
      context.delegate = null;
      return ContinueSentinel;
    }

    var info = record.arg;

    if (! info) {
      context.method = "throw";
      context.arg = new TypeError("iterator result is not an object");
      context.delegate = null;
      return ContinueSentinel;
    }

    if (info.done) {
      // Assign the result of the finished delegate to the temporary
      // variable specified by delegate.resultName (see delegateYield).
      context[delegate.resultName] = info.value;

      // Resume execution at the desired location (see delegateYield).
      context.next = delegate.nextLoc;

      // If context.method was "throw" but the delegate handled the
      // exception, let the outer generator proceed normally. If
      // context.method was "next", forget context.arg since it has been
      // "consumed" by the delegate iterator. If context.method was
      // "return", allow the original .return call to continue in the
      // outer generator.
      if (context.method !== "return") {
        context.method = "next";
        context.arg = undefined;
      }

    } else {
      // Re-yield the result returned by the delegate method.
      return info;
    }

    // The delegate iterator is finished, so forget it and continue with
    // the outer generator.
    context.delegate = null;
    return ContinueSentinel;
  }

  // Define Generator.prototype.{next,throw,return} in terms of the
  // unified ._invoke helper method.
  defineIteratorMethods(Gp);

  define(Gp, toStringTagSymbol, "Generator");

  // A Generator should always return itself as the iterator object when the
  // @@iterator function is called on it. Some browsers' implementations of the
  // iterator prototype chain incorrectly implement this, causing the Generator
  // object to not be returned from this call. This ensures that doesn't happen.
  // See https://github.com/facebook/regenerator/issues/274 for more details.
  Gp[iteratorSymbol] = function() {
    return this;
  };

  Gp.toString = function() {
    return "[object Generator]";
  };

  function pushTryEntry(locs) {
    var entry = { tryLoc: locs[0] };

    if (1 in locs) {
      entry.catchLoc = locs[1];
    }

    if (2 in locs) {
      entry.finallyLoc = locs[2];
      entry.afterLoc = locs[3];
    }

    this.tryEntries.push(entry);
  }

  function resetTryEntry(entry) {
    var record = entry.completion || {};
    record.type = "normal";
    delete record.arg;
    entry.completion = record;
  }

  function Context(tryLocsList) {
    // The root entry object (effectively a try statement without a catch
    // or a finally block) gives us a place to store values thrown from
    // locations where there is no enclosing try statement.
    this.tryEntries = [{ tryLoc: "root" }];
    tryLocsList.forEach(pushTryEntry, this);
    this.reset(true);
  }

  exports.keys = function(object) {
    var keys = [];
    for (var key in object) {
      keys.push(key);
    }
    keys.reverse();

    // Rather than returning an object with a next method, we keep
    // things simple and return the next function itself.
    return function next() {
      while (keys.length) {
        var key = keys.pop();
        if (key in object) {
          next.value = key;
          next.done = false;
          return next;
        }
      }

      // To avoid creating an additional object, we just hang the .value
      // and .done properties off the next function object itself. This
      // also ensures that the minifier will not anonymize the function.
      next.done = true;
      return next;
    };
  };

  function values(iterable) {
    if (iterable) {
      var iteratorMethod = iterable[iteratorSymbol];
      if (iteratorMethod) {
        return iteratorMethod.call(iterable);
      }

      if (typeof iterable.next === "function") {
        return iterable;
      }

      if (!isNaN(iterable.length)) {
        var i = -1, next = function next() {
          while (++i < iterable.length) {
            if (hasOwn.call(iterable, i)) {
              next.value = iterable[i];
              next.done = false;
              return next;
            }
          }

          next.value = undefined;
          next.done = true;

          return next;
        };

        return next.next = next;
      }
    }

    // Return an iterator with no values.
    return { next: doneResult };
  }
  exports.values = values;

  function doneResult() {
    return { value: undefined, done: true };
  }

  Context.prototype = {
    constructor: Context,

    reset: function(skipTempReset) {
      this.prev = 0;
      this.next = 0;
      // Resetting context._sent for legacy support of Babel's
      // function.sent implementation.
      this.sent = this._sent = undefined;
      this.done = false;
      this.delegate = null;

      this.method = "next";
      this.arg = undefined;

      this.tryEntries.forEach(resetTryEntry);

      if (!skipTempReset) {
        for (var name in this) {
          // Not sure about the optimal order of these conditions:
          if (name.charAt(0) === "t" &&
              hasOwn.call(this, name) &&
              !isNaN(+name.slice(1))) {
            this[name] = undefined;
          }
        }
      }
    },

    stop: function() {
      this.done = true;

      var rootEntry = this.tryEntries[0];
      var rootRecord = rootEntry.completion;
      if (rootRecord.type === "throw") {
        throw rootRecord.arg;
      }

      return this.rval;
    },

    dispatchException: function(exception) {
      if (this.done) {
        throw exception;
      }

      var context = this;
      function handle(loc, caught) {
        record.type = "throw";
        record.arg = exception;
        context.next = loc;

        if (caught) {
          // If the dispatched exception was caught by a catch block,
          // then let that catch block handle the exception normally.
          context.method = "next";
          context.arg = undefined;
        }

        return !! caught;
      }

      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        var record = entry.completion;

        if (entry.tryLoc === "root") {
          // Exception thrown outside of any try block that could handle
          // it, so set the completion value of the entire function to
          // throw the exception.
          return handle("end");
        }

        if (entry.tryLoc <= this.prev) {
          var hasCatch = hasOwn.call(entry, "catchLoc");
          var hasFinally = hasOwn.call(entry, "finallyLoc");

          if (hasCatch && hasFinally) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            } else if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else if (hasCatch) {
            if (this.prev < entry.catchLoc) {
              return handle(entry.catchLoc, true);
            }

          } else if (hasFinally) {
            if (this.prev < entry.finallyLoc) {
              return handle(entry.finallyLoc);
            }

          } else {
            throw new Error("try statement without catch or finally");
          }
        }
      }
    },

    abrupt: function(type, arg) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc <= this.prev &&
            hasOwn.call(entry, "finallyLoc") &&
            this.prev < entry.finallyLoc) {
          var finallyEntry = entry;
          break;
        }
      }

      if (finallyEntry &&
          (type === "break" ||
           type === "continue") &&
          finallyEntry.tryLoc <= arg &&
          arg <= finallyEntry.finallyLoc) {
        // Ignore the finally entry if control is not jumping to a
        // location outside the try/catch block.
        finallyEntry = null;
      }

      var record = finallyEntry ? finallyEntry.completion : {};
      record.type = type;
      record.arg = arg;

      if (finallyEntry) {
        this.method = "next";
        this.next = finallyEntry.finallyLoc;
        return ContinueSentinel;
      }

      return this.complete(record);
    },

    complete: function(record, afterLoc) {
      if (record.type === "throw") {
        throw record.arg;
      }

      if (record.type === "break" ||
          record.type === "continue") {
        this.next = record.arg;
      } else if (record.type === "return") {
        this.rval = this.arg = record.arg;
        this.method = "return";
        this.next = "end";
      } else if (record.type === "normal" && afterLoc) {
        this.next = afterLoc;
      }

      return ContinueSentinel;
    },

    finish: function(finallyLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.finallyLoc === finallyLoc) {
          this.complete(entry.completion, entry.afterLoc);
          resetTryEntry(entry);
          return ContinueSentinel;
        }
      }
    },

    "catch": function(tryLoc) {
      for (var i = this.tryEntries.length - 1; i >= 0; --i) {
        var entry = this.tryEntries[i];
        if (entry.tryLoc === tryLoc) {
          var record = entry.completion;
          if (record.type === "throw") {
            var thrown = record.arg;
            resetTryEntry(entry);
          }
          return thrown;
        }
      }

      // The context.catch method must only be called with a location
      // argument that corresponds to a known catch block.
      throw new Error("illegal catch attempt");
    },

    delegateYield: function(iterable, resultName, nextLoc) {
      this.delegate = {
        iterator: values(iterable),
        resultName: resultName,
        nextLoc: nextLoc
      };

      if (this.method === "next") {
        // Deliberately forget the last sent value so that we don't
        // accidentally pass it on to the delegate.
        this.arg = undefined;
      }

      return ContinueSentinel;
    }
  };

  // Regardless of whether this script is executing as a CommonJS module
  // or not, return the runtime object so that we can declare the variable
  // regeneratorRuntime in the outer scope, which allows this module to be
  // injected easily by `bin/regenerator --include-runtime script.js`.
  return exports;

}(
  // If this script is executing as a CommonJS module, use module.exports
  // as the regeneratorRuntime namespace. Otherwise create a new empty
  // object. Either way, the resulting object will be used to initialize
  // the regeneratorRuntime variable at the top of this file.
   true ? module.exports : 0
));

try {
  regeneratorRuntime = runtime;
} catch (accidentalStrictMode) {
  // This module should not be running in strict mode, so the above
  // assignment should always work unless something is misconfigured. Just
  // in case runtime.js accidentally runs in strict mode, we can escape
  // strict mode using a global Function call. This could conceivably fail
  // if a Content Security Policy forbids using Function, but in that case
  // the proper solution is to fix the accidental strict mode problem. If
  // you've misconfigured your bundler to force strict mode and applied a
  // CSP to forbid Function, and you're not willing to fix either of those
  // problems, please detail your unique predicament in a GitHub issue.
  Function("r", "regeneratorRuntime = r")(runtime);
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!************************************!*\
  !*** ./resources/js/dinway/faq.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_faq_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/faq/index */ "./resources/js/dinway/components/faq/index.js");

})();

/******/ })()
;