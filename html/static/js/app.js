/* eslint-disable no-empty */
/* eslint-disable no-unused-vars */
/* jshint esversion: 9 */

// ------------------------------------------------------------
// alpine.js utils
// ------------------------------------------------------------
function dispatchOnNextPage(item, data) {
    localStorage.dispatch = JSON.stringify({
        item,
        data,
    });
}

function getStack(el) {
    if (typeof el === 'string') {
        if (document.getElementById(el)?._x_dataStack) {
            return document.getElementById(el)?._x_dataStack[0];
        }
        return {};
    }
    return el?._x_dataStack[0];
}

function get(url, targetAndSelect, select) {
    targetAndSelect = targetAndSelect || '#main';
    select = select || targetAndSelect;
    htmx.ajax('GET', url, {
        swap: 'outerHTML',
        target: targetAndSelect,
        select,
    })
}
// ------------------------------------------------------------

// DOM utility functions
function $(selector) {
    return selector.startsWith('#') && selector.indexOf(' ') === -1
        ? document.querySelector(selector)
        : document.querySelectorAll(selector);
}

function onDocReady(callback, timeout = 0) {
    if (/complete|interactive|loaded/.test(document.readyState)) {
        setTimeout(callback, timeout);
    } else {
        document.addEventListener('DOMContentLoaded', () => setTimeout(callback, timeout));
    }
}

// Close dropdowns when clicking outside
document.addEventListener('mouseup', (event) => {
    let ele = event.target;
    while (ele.tagName && ele.tagName !== 'BODY' && ele.tagName !== 'DETAILS') {
        ele = ele.parentNode;
    }
    if (ele.tagName === 'DETAILS') return;

    try {
        document.querySelectorAll('details[role=list][open]')
            .forEach(details => details.removeAttribute('open'));
    } catch (er) { }
});

// Modal functionality
(function (modal) {
    function clickClose(event) {
        if (event.target.tagName.toLowerCase() === 'dialog' && event.target.getAttribute('open') === 'true') {
            document.querySelector('dialog[open]').removeAttribute('open');
            document.documentElement.classList.remove('no-scollbars');
            document.removeEventListener('click', clickClose);
            document.removeEventListener('keydown', escClose);
        }
    }

    function escClose(event) {
        if (event.key === 'Escape') {
            document.querySelector('dialog[open]').removeAttribute('open');
            document.documentElement.classList.remove('no-scollbars');
            document.removeEventListener('click', clickClose);
            document.removeEventListener('keydown', escClose);
        }
    }

    function getDialog(event) {
        return typeof event === 'string'
            ? document.getElementById(event)
            : document.getElementById(event.currentTarget.getAttribute('data-target'));
    }

    modal.show = function (event, allowCloseOutside = true) {
        const dialog = getDialog(event);
        if (typeof event !== 'string') {
            event.preventDefault();
        }

        dialog.setAttribute('open', true);
        document.documentElement.classList.add('no-scollbars');

        if (allowCloseOutside) {
            document.addEventListener('click', clickClose);
            document.addEventListener('keydown', escClose);
        }
    };

    modal.hide = function (event) {
        const dialog = getDialog(event);
        if (typeof event !== 'string') {
            event.preventDefault();
        }

        dialog.removeAttribute('open');
        document.documentElement.classList.remove('no-scollbars');
        document.removeEventListener('click', clickClose);
        document.removeEventListener('keydown', escClose);
    };

    modal.toggle = function (event, allowCloseOutside = true) {
        const dialog = getDialog(event);
        if (typeof event !== 'string') {
            event.preventDefault();
        }

        dialog.getAttribute('open') !== 'true'
            ? modal.show(event, allowCloseOutside)
            : modal.hide(event);
    };
}(window.modal = window.modal || {}));

// Platform detection
function detectPlatform() {
    const html = document.querySelector('html');
    if (window.navigator.standalone) {
        html.classList.add('pwa');
    }
    if ((window.navigator.userAgentData?.platform) === 'macOS' || (window.navigator.platform || '') === 'MacIntel') {
        html.classList.add('mac');
    }
    if (window.navigator.userAgentData?.mobile) {
        html.classList.add('mobile');
    }
}
detectPlatform();

// Utility functions
function copyObject(obj) {
    return JSON.parse(JSON.stringify(obj));
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// CSRF utility functions
window.csrf = window.csrf || {
    getToken: function () {
        return $('input[name="csrf_token"]')[0]?.value;
    },

    attachToken: function (data) {
        return { ...data, csrf_token: this.getToken() };
    }
};

function isSameJSON(obj1, obj2) {
    return JSON.stringify(obj1) === JSON.stringify(obj2);
}

function isEmpty(x) {
    if (x == null || x === '' || x === undefined) return true;
    if (Array.isArray(x) || typeof x === 'string') return x.length === 0;
    if (typeof x === 'object') return Object.keys(x).length === 0;
    return false;
}

function copyToClipboard(ele) {
    const text = typeof ele === 'string' ? ele : (ele.innerText || ele.value);
    navigator.clipboard.writeText(text);
}
function copyToClipboardWithConfirmation(text, message, ele) {
    navigator.clipboard.writeText(text);
    const html = ele.innerHTML
    ele.innerHTML = message;
    setTimeout(() => { ele.innerHTML = html }, 750);
}

function showTempText(ele, tempText) {
    const originalText = $(ele).innerHTML;
    $(ele).innerHTML = tempText;
    setTimeout(() => { $(ele).innerHTML = originalText }, 750);
}

// Scroll handling with debounce
let scrollTimer = null;
onDocReady(() => {
    function handleScroll() {
        document.documentElement.style.setProperty('--scroll-offset', window.scrollY + 'px');
        document.documentElement.setAttribute('data-scrolled', (window.scrollY / window.innerHeight) > 0.2);
    }

    window.addEventListener("scroll", () => {
        if (scrollTimer !== null) clearTimeout(scrollTimer);
        scrollTimer = setTimeout(handleScroll, 25);
    }, { passive: true });

    handleScroll(); // Initial call
});

// Loading state management
function showLoading(ele) {
    function applyLoading(element) {
        element.setAttribute('disabled', true);
        element.setAttribute('aria-busy', true);
        element.classList.add('busy');
    }

    if (!ele) {
        ele = [...document.querySelectorAll('button[type="submit"]')];
    }
    if (!ele) return;

    Array.isArray(ele) ? ele.forEach(applyLoading) : applyLoading(ele);
}

function hideLoading(ele) {
    function removeLoading(element) {
        element.removeAttribute('disabled');
        element.removeAttribute('aria-busy');
        element.classList.remove('busy');
    }

    if (ele) {
        removeLoading(ele);
    } else {
        document.querySelectorAll('.busy').forEach(removeLoading);
    }
}

/* ---------------------------------------------------------------------------- */
/* --- Toast notifications --- */

function toastifyErrors(errors) {
    return errors.map((err) => {
        err.level = 'error';
        return err;
    });
}

function showToast(messages) {
    window.toasted = window.toasted || false;
    onDocReady(() => {
        if (!window.toasted) {
            const stack = getStack('toasts');
            stack.addToastMessage(messages);
            window.toasted = true;
            setTimeout(() => {
                window.toasted = false;
            }, 1000);
        }
    })
}

function toast(count) {
    return {
        toastsClass: '',
        previousToastUid: null,
        toastMessages: [
            // {
            //   id: 'some_id',
            //   level: 'warning', // error, warning, info, success
            //   title: 'Optional title',
            //   message: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
            //   uid: Math.floor(Math.random() * (1e9-100 + 1)) + 100
            // },
        ],
        removeToastMessage(uid) {
            try {
                $(`#toast-${uid}`).classList.add('toast-leave-to');
            } catch (er) { }
            setTimeout(() => {
                this.toastMessages = this.toastMessages.filter((m) => m.uid !== uid);
            }, 100);
        },

        fadeToast(uid, timeout = 5000) {
            const timer = setTimeout(() => {
                try {
                    $(`#toast-${uid}`).classList.add('toast-leave-to');
                } catch (er) { }
                setTimeout(() => {
                    this.toastMessages = this.toastMessages.filter((m) => m.uid !== uid);
                }, 100);
            }, timeout);

            this.$nextTick(() => {
                if ($(`#toast-${uid}`)) {
                    $(`#toast-${uid}`).addEventListener('mouseenter', () => {
                        clearTimeout(timer);
                        $(`#toast-${uid}`).addEventListener('mouseleave', () => {
                            this.fadeToast(uid, 2000);
                        });
                    });
                }
            })
        },

        addToastMessage(messages) {
            if (!Array.isArray(messages)) {
                messages = [messages];
            }

            /**
             * Message example:
             * {
             *  id: 'NOT_FOUND',
             *  level: 'info', // error, warning, info, success (defaults to "info")
             *  title: 'Optional title',
             *  message: 'Entity not found'
             * }
             */
            messages.map(msg => {
                const uid = Math.floor(Math.random() * (1e9 - 100 + 1)) + 100;
                msg.uid = uid;
                msg.title = msg.title || '';
                msg.level = (msg.level || 'info').toLowerCase();

                // enter transition
                this.toastsClass = 'entering';
                if (this.previousToastUid) {
                    try {
                        $(`#toast-${this.previousToastUid}`).classList.add('entering');
                        setTimeout(() => {
                            try {
                                $(`#toast-${this.previousToastUid}`).classList.remove('entering');
                            } catch (er) { }
                        }, 200);
                    } catch (er) { }
                }
                this.toastMessages.unshift(msg);

                setTimeout(() => {
                    this.toastsClass = '';
                }, 10);

                // leave transition
                // setTimeout(() => {
                //   try {
                //     $(`#toast-${uid}`).classList.add('toast-leave-to');
                //   } catch (er) { }
                //   setTimeout(() => {
                //     this.toastMessages = this.toastMessages.filter((m) => m.uid !== uid);
                //   }, 100);
                // }, 5000);
                this.fadeToast(uid);

                this.previousToastUid = uid;
            });
        }
    };
}


/* ---------------------------------------------------------------------------- */
/* --- Rusure dialog --- */
(function (rusure, undefined) {
    rusure.show = function (msg, { title, question, button, warning, onConfirm, onCancel, doubleConfirmation, hideOnConfirm = true, params = [] } = {}) {
        msg = msg || 'Are you sure you want to proceed?';
        if (!onConfirm) {
            onConfirm = () => { };
        }
        if (!onCancel) {
            onCancel = () => { };
        }
        onDocReady(() => {
            // eslint-disable-next-line no-underscore-dangle
            const stack = getStack('rusure-dialog');
            stack.title = title || 'Are you sure?';
            stack.msg = msg;
            stack.question = question || 'Are you sure you want to proceed?';
            stack.button = button || 'Yes, please proceed';
            stack.warning = typeof warning == 'undefined' ? true : warning,
                stack.params = params;
            stack.confirmCallback = onConfirm;
            stack.cancelCallback = onCancel;
            stack.doubleConfirmation = doubleConfirmation || false;
            stack.hideOnConfirm = hideOnConfirm;
            stack.show = true;
            document.getElementById('rusure-dialog').focus();
        });
    };

    rusure.cancel = function () {
        onDocReady(() => {
            // eslint-disable-next-line no-underscore-dangle
            const stack = getStack('rusure-dialog');
            stack.cancel();
        });
    };

}(window.rusure = window.rusure || {}));

function rusureDialog() {
    return {
        show: false,
        title: '',
        msg: '',
        question: '',
        button: 'Yes, please proceed',
        warning: true,
        doubleConfirmation: false,
        // transitionClass: 'fade-in',
        confirmCallback: () => { },
        cancelCallback: () => { },
        clicks: 0,
        params: [],

        init() {
            // console.log('init');
            // this.confirm();
        },

        rusureConfirm() {
            this.clicks++;
            const button = document.getElementById('rusure-button');
            // if (this.clicks == 1) {
            //   this.button = button.innerHTML;
            // }
            if (this.doubleConfirmation) {
                button.style.width = button.offsetWidth + 'px';
                button.classList.add('scale-95');
                button.classList.add('opacity-75');
                setTimeout(() => {
                    button.classList.remove('scale-95');
                    button.classList.remove('opacity-75');
                }, 200);
                button.innerHTML = 'Click again to confirm...';
                this.doubleConfirmation = false;
                return;
            }
            button.innerHTML = 'Executing...'; // this.button
            showLoading(button);
            this.confirmCallback(...this.params);
            if (this.hideOnConfirm) {
                hideLoading(button);
                this.hide();
            }
        },

        hide() {
            this.show = false;
            setTimeout(() => {
                this.title = 'Are you sure?';
                this.msg = '';
                this.button = 'Yes, please proceed';
                this.params = [];
                this.confirmCallback = () => { };
                this.cancelCallback = () => { };
            }, 750);
        },

        rusureCancel() {
            this.cancelCallback(...this.params);
            this.hide();
        }
    };
}

/* ---------------------------------------------------------------------------- */
/* --- we need this to make htmx + alpine work together (back button issue) --- */
// Stack management for HTMX + Alpine
window.appScriptWaitInterval = [];
window.$stack = window.$stack || {
    get: function (el) {
        if (typeof el === 'string') {
            const element = document.getElementById(el);
            return element?._x_dataStack ? element._x_dataStack[0] : {};
        }
        return el?._x_dataStack[0];
    },

    markAsUnloaded: function (el) {
        this.get(el).loaded = false;
    },

    markAsLoaded: function (el) {
        this.get(el).loaded = true;
    },

    waitUntilLoaded: function (func, component, triesLeft = 100) {
        this.markAsUnloaded(component);
        window.appScriptWaitInterval[func] = setInterval(() => {
            if (typeof window[func] === 'function') {
                clearInterval(window.appScriptWaitInterval[func]);
                this.markAsLoaded(component);
            }
            if (--triesLeft <= 0) {
                clearInterval(window.appScriptWaitInterval[func]);
            }
        }, 10);
    },

    handleFrom: function (form, stack, func = 'submit') {
        onDocReady(() => {
            const formElement = typeof form === 'string' ? document.querySelector(form) : form;
            const stackObj = this.get(stack);
            const handler = (e) => stackObj[func](e);

            formElement.addEventListener('submit', handler);
            formElement.addEventListener('htmx:beforeRequest', handler);
        });
    },

    init: function () {
        document.addEventListener('alpine:init', () => {
            const template = document.querySelector('template');
            if (template) {
                template.content.firstElementChild.setAttribute('x-role', 'template');
            }
            onDocReady(() => this.markAsLoaded('content-wrapper'));
        });

        window.addEventListener('htmx:beforeRequest', (req) => {
            if (req.detail.requestConfig.headers['HX-Swap'] === 'none') return;
            document.querySelectorAll('[x-role="template"]:not([hx-noswap])').forEach(el => el.remove());
        });

        window.addEventListener('htmx:afterSwap', () => {
            onDocReady(() => {
                const component = $('#content-wrapper');
                if (component) {
                    const template = component.querySelector('template');
                    if (template) {
                        const func = template.content.querySelector('[x-data]')?.getAttribute('x-data');
                        if (func) {
                            this.waitUntilLoaded(func, 'content-wrapper', 100);
                        }
                    }
                }
            });
        });
    }
};
window.$stack.init();

/* ---------------------------------------------------------------------------- */
// Core application functionality
function app() {
    return {
        sidebar: false,
        dispatch: localStorage.dispatch ? JSON.parse(localStorage.dispatch) : null,

        init() {
            if (!isEmpty(this.dispatch)) {
                onDocReady(() => {
                    this.$dispatch(this.dispatch.item, this.dispatch.data);
                    this.dispatch = null;
                    delete localStorage.dispatch;
                }, 750);
            }
        }
    };
}

/* ---------------------------------------------------------------------------- */
// HTMX helper
function get(url, targetAndSelect, select) {
    htmx.ajax('GET', url, {
        swap: 'outerHTML',
        target: targetAndSelect || '#main',
        select: select || targetAndSelect
    });
}

/* ---------------------------------------------------------------------------- */
//
function capFirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function generateName(capitalize) {
    capitalize = capitalize || false;
    let name1 = ["abandoned", "able", "absolute", "adorable", "adventurous", "academic", "acceptable", "acclaimed", "accomplished", "accurate", "aching", "acidic", "acrobatic", "active", "actual", "adept", "admirable", "admired", "adolescent", "adorable", "adored", "advanced", "afraid", "affectionate", "aged", "aggravating", "aggressive", "agile", "agitated", "agonizing", "agreeable", "ajar", "alarmed", "alarming", "alert", "alienated", "alive", "all", "altruistic", "amazing", "ambitious", "ample", "amused", "amusing", "anchored", "ancient", "angelic", "angry", "anguished", "animated", "annual", "another", "antique", "anxious", "any", "apprehensive", "appropriate", "apt", "arctic", "arid", "aromatic", "artistic", "ashamed", "assured", "astonishing", "athletic", "attached", "attentive", "attractive", "austere", "authentic", "authorized", "automatic", "avaricious", "average", "aware", "awesome", "awful", "awkward", "babyish", "bad", "back", "baggy", "bare", "barren", "basic", "beautiful", "belated", "beloved", "beneficial", "better", "best", "bewitched", "big", "big-hearted", "biodegradable", "bite-sized", "bitter", "black", "black-and-white", "bland", "blank", "blaring", "bleak", "blind", "blissful", "blond", "blue", "blushing", "bogus", "boiling", "bold", "bony", "boring", "bossy", "both", "bouncy", "bountiful", "bowed", "brave", "breakable", "brief", "bright", "brilliant", "brisk", "broken", "bronze", "brown", "bruised", "bubbly", "bulky", "bumpy", "buoyant", "burdensome", "burly", "bustling", "busy", "buttery", "buzzing", "calculating", "calm", "candid", "canine", "capital", "carefree", "careful", "careless", "caring", "cautious", "cavernous", "celebrated", "charming", "cheap", "cheerful", "cheery", "chief", "chilly", "chubby", "circular", "classic", "clean", "clear", "clear-cut", "clever", "close", "closed", "cloudy", "clueless", "clumsy", "cluttered", "coarse", "cold", "colorful", "colorless", "colossal", "comfortable", "common", "compassionate", "competent", "complete", "complex", "complicated", "composed", "concerned", "concrete", "confused", "conscious", "considerate", "constant", "content", "conventional", "cooked", "cool", "cooperative", "coordinated", "corny", "corrupt", "costly", "courageous", "courteous", "crafty", "crazy", "creamy", "creative", "creepy", "criminal", "crisp", "critical", "crooked", "crowded", "cruel", "crushing", "cuddly", "cultivated", "cultured", "cumbersome", "curly", "curvy", "cute", "cylindrical", "damaged", "damp", "dangerous", "dapper", "daring", "darling", "dark", "dazzling", "dead", "deadly", "deafening", "dear", "dearest", "decent", "decimal", "decisive", "deep", "defenseless", "defensive", "defiant", "deficient", "definite", "definitive", "delayed", "delectable", "delicious", "delightful", "delirious", "demanding", "dense", "dental", "dependable", "dependent", "descriptive", "deserted", "detailed", "determined", "devoted", "different", "difficult", "digital", "diligent", "dim", "dimpled", "dimwitted", "direct", "disastrous", "discrete", "disfigured", "disgusting", "disloyal", "dismal", "distant", "downright", "dreary", "dirty", "disguised", "dishonest", "dismal", "distant", "distinct", "distorted", "dizzy", "dopey", "doting", "double", "downright", "drab", "drafty", "dramatic", "dreary", "droopy", "dry", "dual", "dull", "dutiful", "each", "eager", "earnest", "early", "easy", "easy-going", "ecstatic", "edible", "educated", "elaborate", "elastic", "elated", "elderly", "electric", "elegant", "elementary", "elliptical", "embarrassed", "embellished", "eminent", "emotional", "empty", "enchanted", "enchanting", "energetic", "enlightened", "enormous", "enraged", "entire", "envious", "equal", "equatorial", "essential", "esteemed", "ethical", "euphoric", "even", "evergreen", "everlasting", "every", "evil", "exalted", "excellent", "exemplary", "exhausted", "excitable", "excited", "exciting", "exotic", "expensive", "experienced", "expert", "extraneous", "extroverted", "extra-large", "extra-small", "fabulous", "failing", "faint", "fair", "faithful", "fake", "false", "familiar", "famous", "fancy", "fantastic", "far", "faraway", "far-flung", "far-off", "fast", "fat", "fatal", "fatherly", "favorable", "favorite", "fearful", "fearless", "feisty", "feline", "female", "feminine", "few", "fickle", "filthy", "fine", "finished", "firm", "first", "firsthand", "fitting", "fixed", "flaky", "flamboyant", "flashy", "flat", "flawed", "flawless", "flickering", "flimsy", "flippant", "flowery", "fluffy", "fluid", "flustered", "focused", "fond", "foolhardy", "foolish", "forceful", "forked", "formal", "forsaken", "forthright", "fortunate", "fragrant", "frail", "frank", "frayed", "free", "French", "fresh", "frequent", "friendly", "frightened", "frightening", "frigid", "frilly", "frizzy", "frivolous", "front", "frosty", "frozen", "frugal", "fruitful", "full", "fumbling", "functional", "funny", "fussy", "fuzzy", "gargantuan", "gaseous", "general", "generous", "gentle", "genuine", "giant", "giddy", "gigantic", "gifted", "giving", "glamorous", "glaring", "glass", "gleaming", "gleeful", "glistening", "glittering", "gloomy", "glorious", "glossy", "glum", "golden", "good", "good-natured", "gorgeous", "graceful", "gracious", "grand", "grandiose", "granular", "grateful", "grave", "gray", "great", "greedy", "green", "gregarious", "grim", "grimy", "gripping", "grizzled", "gross", "grotesque", "grouchy", "grounded", "growing", "growling", "grown", "grubby", "gruesome", "grumpy", "guilty", "gullible", "gummy", "hairy", "half", "handmade", "handsome", "handy", "happy", "happy-go-lucky", "hard", "hard-to-find", "harmful", "harmless", "harmonious", "harsh", "hasty", "hateful", "haunting", "healthy", "heartfelt", "hearty", "heavenly", "heavy", "hefty", "helpful", "helpless", "hidden", "hideous", "high", "high-level", "hilarious", "hoarse", "hollow", "homely", "honest", "honorable", "honored", "hopeful", "horrible", "hospitable", "hot", "huge", "humble", "humiliating", "humming", "humongous", "hungry", "hurtful", "husky", "icky", "icy", "ideal", "idealistic", "identical", "idle", "idiotic", "idolized", "ignorant", "ill", "illegal", "ill-fated", "ill-informed", "illiterate", "illustrious", "imaginary", "imaginative", "immaculate", "immaterial", "immediate", "immense", "impassioned", "impeccable", "impartial", "imperfect", "imperturbable", "impish", "impolite", "important", "impossible", "impractical", "impressionable", "impressive", "improbable", "impure", "inborn", "incomparable", "incompatible", "incomplete", "inconsequential", "incredible", "indelible", "inexperienced", "indolent", "infamous", "infantile", "infatuated", "inferior", "infinite", "informal", "innocent", "insecure", "insidious", "insignificant", "insistent", "instructive", "insubstantial", "intelligent", "intent", "intentional", "interesting", "internal", "international", "intrepid", "ironclad", "irresponsible", "irritating", "itchy", "jaded", "jagged", "jam-packed", "jaunty", "jealous", "jittery", "joint", "jolly", "jovial", "joyful", "joyous", "jubilant", "judicious", "juicy", "jumbo", "junior", "jumpy", "juvenile", "kaleidoscopic", "keen", "key", "kind", "kindhearted", "kindly", "klutzy", "knobby", "knotty", "knowledgeable", "knowing", "known", "kooky", "kosher", "lame", "lanky", "large", "last", "lasting", "late", "lavish", "lawful", "lazy", "leading", "lean", "leafy", "left", "legal", "legitimate", "light", "lighthearted", "likable", "likely", "limited", "limp", "limping", "linear", "lined", "liquid", "little", "live", "lively", "livid", "loathsome", "lone", "lonely", "long", "long-term", "loose", "lopsided", "lost", "loud", "lovable", "lovely", "loving", "low", "loyal", "lucky", "lumbering", "luminous", "lumpy", "lustrous", "luxurious", "mad", "made-up", "magnificent", "majestic", "major", "male", "mammoth", "married", "marvelous", "masculine", "massive", "mature", "meager", "mealy", "mean", "measly", "meaty", "medical", "mediocre", "medium", "meek", "mellow", "melodic", "memorable", "menacing", "merry", "messy", "metallic", "mild", "milky", "mindless", "miniature", "minor", "minty", "miserable", "miserly", "misguided", "misty", "mixed", "modern", "modest", "moist", "monstrous", "monthly", "monumental", "moral", "mortified", "motherly", "motionless", "mountainous", "muddy", "muffled", "multicolored", "mundane", "murky", "mushy", "musty", "muted", "mysterious", "naive", "narrow", "nasty", "natural", "naughty", "nautical", "near", "neat", "necessary", "needy", "negative", "neglected", "negligible", "neighboring", "nervous", "new", "next", "nice", "nifty", "nimble", "nippy", "nocturnal", "noisy", "nonstop", "normal", "notable", "noted", "noteworthy", "novel", "noxious", "numb", "nutritious", "nutty", "obedient", "obese", "oblong", "oily", "oblong", "obvious", "occasional", "odd", "oddball", "offbeat", "offensive", "official", "old", "old-fashioned", "only", "open", "optimal", "optimistic", "opulent", "orange", "orderly", "organic", "ornate", "ornery", "ordinary", "original", "other", "our", "outlying", "outgoing", "outlandish", "outrageous", "outstanding", "oval", "overcooked", "overdue", "overjoyed", "overlooked", "palatable", "pale", "paltry", "parallel", "parched", "partial", "passionate", "past", "pastel", "peaceful", "peppery", "perfect", "perfumed", "periodic", "perky", "personal", "pertinent", "pesky", "pessimistic", "petty", "phony", "physical", "piercing", "pink", "pitiful", "plain", "plaintive", "plastic", "playful", "pleasant", "pleased", "pleasing", "plump", "plush", "polished", "polite", "political", "pointed", "pointless", "poised", "poor", "popular", "portly", "posh", "positive", "possible", "potable", "powerful", "powerless", "practical", "precious", "present", "prestigious", "pretty", "precious", "previous", "pricey", "prickly", "primary", "prime", "pristine", "private", "prize", "probable", "productive", "profitable", "profuse", "proper", "proud", "prudent", "punctual", "pungent", "puny", "pure", "purple", "pushy", "putrid", "puzzled", "puzzling", "quaint", "qualified", "quarrelsome", "quarterly", "queasy", "querulous", "questionable", "quick", "quick-witted", "quiet", "quintessential", "quirky", "quixotic", "quizzical", "radiant", "ragged", "rapid", "rare", "rash", "raw", "recent", "reckless", "rectangular", "ready", "real", "realistic", "reasonable", "red", "reflecting", "regal", "regular", "reliable", "relieved", "remarkable", "remorseful", "remote", "repentant", "required", "respectful", "responsible", "repulsive", "revolving", "rewarding", "rich", "rigid", "right", "ringed", "ripe", "roasted", "robust", "rosy", "rotating", "rotten", "rough", "round", "rowdy", "royal", "rubbery", "rundown", "ruddy", "rude", "runny", "rural", "rusty", "sad", "safe", "salty", "same", "sandy", "sane", "sarcastic", "sardonic", "satisfied", "scaly", "scarce", "scared", "scary", "scented", "scholarly", "scientific", "scornful", "scratchy", "scrawny", "second", "secondary", "second-hand", "secret", "self-assured", "self-reliant", "selfish", "sentimental", "separate", "serene", "serious", "serpentine", "several", "severe", "shabby", "shadowy", "shady", "shallow", "shameful", "shameless", "sharp", "shimmering", "shiny", "shocked", "shocking", "shoddy", "short", "short-term", "showy", "shrill", "shy", "sick", "silent", "silky", "silly", "silver", "similar", "simple", "simplistic", "sinful", "single", "sizzling", "skeletal", "skinny", "sleepy", "slight", "slim", "slimy", "slippery", "slow", "slushy", "small", "smart", "smoggy", "smooth", "smug", "snappy", "snarling", "sneaky", "sniveling", "snoopy", "sociable", "soft", "soggy", "solid", "somber", "some", "spherical", "sophisticated", "sore", "sorrowful", "soulful", "soupy", "sour", "Spanish", "sparkling", "sparse", "specific", "spectacular", "speedy", "spicy", "spiffy", "spirited", "spiteful", "splendid", "spotless", "spotted", "spry", "square", "squeaky", "squiggly", "stable", "staid", "stained", "stale", "standard", "starchy", "stark", "starry", "steep", "sticky", "stiff", "stimulating", "stingy", "stormy", "straight", "strange", "steel", "strict", "strident", "striking", "striped", "strong", "studious", "stunning", "stupendous", "stupid", "sturdy", "stylish", "subdued", "submissive", "substantial", "subtle", "suburban", "sudden", "sugary", "sunny", "super", "superb", "superficial", "superior", "supportive", "sure-footed", "surprised", "suspicious", "svelte", "sweaty", "sweet", "sweltering", "swift", "sympathetic", "tall", "talkative", "tame", "tan", "tangible", "tart", "tasty", "tattered", "taut", "tedious", "teeming", "tempting", "tender", "tense", "tepid", "terrible", "terrific", "testy", "thankful", "that", "these", "thick", "thin", "third", "thirsty", "this", "thorough", "thorny", "those", "thoughtful", "threadbare", "thrifty", "thunderous", "tidy", "tight", "timely", "tinted", "tiny", "tired", "torn", "total", "tough", "traumatic", "treasured", "tremendous", "tragic", "trained", "tremendous", "triangular", "tricky", "trifling", "trim", "trivial", "troubled", "true", "trusting", "trustworthy", "trusty", "truthful", "tubby", "turbulent", "twin", "ugly", "ultimate", "unacceptable", "unaware", "uncomfortable", "uncommon", "unconscious", "understated", "unequaled", "uneven", "unfinished", "unfit", "unfolded", "unfortunate", "unhappy", "unhealthy", "uniform", "unimportant", "unique", "united", "unkempt", "unknown", "unlawful", "unlined", "unlucky", "unnatural", "unpleasant", "unrealistic", "unripe", "unruly", "unselfish", "unsightly", "unsteady", "unsung", "untidy", "untimely", "untried", "untrue", "unused", "unusual", "unwelcome", "unwieldy", "unwilling", "unwitting", "unwritten", "upbeat", "upright", "upset", "urban", "usable", "used", "useful", "useless", "utilized", "utter", "vacant", "vague", "vain", "valid", "valuable", "vapid", "variable", "vast", "velvety", "venerated", "vengeful", "verifiable", "vibrant", "vicious", "victorious", "vigilant", "vigorous", "villainous", "violet", "violent", "virtual", "virtuous", "visible", "vital", "vivacious", "vivid", "voluminous", "wan", "warlike", "warm", "warmhearted", "warped", "wary", "wasteful", "watchful", "waterlogged", "watery", "wavy", "wealthy", "weak", "weary", "webbed", "wee", "weekly", "weepy", "weighty", "weird", "welcome", "well-documented", "well-groomed", "well-informed", "well-lit", "well-made", "well-off", "well-to-do", "well-worn", "wet", "which", "whimsical", "whirlwind", "whispered", "white", "whole", "whopping", "wicked", "wide", "wide-eyed", "wiggly", "wild", "willing", "wilted", "winding", "windy", "winged", "wiry", "wise", "witty", "wobbly", "woeful", "wonderful", "wooden", "woozy", "wordy", "worldly", "worn", "worried", "worrisome", "worse", "worst", "worthless", "worthwhile", "worthy", "wrathful", "wretched", "writhing", "wrong", "wry", "yawning", "yearly", "yellow", "yellowish", "young", "youthful", "yummy", "zany", "zealous", "zesty", "zigzag", "rocky"];
    let name2 = ["people", "history", "way", "art", "world", "information", "map", "family", "government", "health", "system", "computer", "meat", "year", "thanks", "music", "person", "reading", "method", "data", "food", "understanding", "theory", "law", "bird", "literature", "problem", "software", "control", "knowledge", "power", "ability", "economics", "love", "internet", "television", "science", "library", "nature", "fact", "product", "idea", "temperature", "investment", "area", "society", "activity", "story", "industry", "media", "thing", "oven", "community", "definition", "safety", "quality", "development", "language", "management", "player", "variety", "video", "week", "security", "country", "exam", "movie", "organization", "equipment", "physics", "analysis", "policy", "series", "thought", "basis", "boyfriend", "direction", "strategy", "technology", "army", "camera", "freedom", "paper", "environment", "child", "instance", "month", "truth", "marketing", "university", "writing", "article", "department", "difference", "goal", "news", "audience", "fishing", "growth", "income", "marriage", "user", "combination", "failure", "meaning", "medicine", "philosophy", "teacher", "communication", "night", "chemistry", "disease", "disk", "energy", "nation", "road", "role", "soup", "advertising", "location", "success", "addition", "apartment", "education", "math", "moment", "painting", "politics", "attention", "decision", "event", "property", "shopping", "student", "wood", "competition", "distribution", "entertainment", "office", "population", "president", "unit", "category", "cigarette", "context", "introduction", "opportunity", "performance", "driver", "flight", "length", "magazine", "newspaper", "relationship", "teaching", "cell", "dealer", "debate", "finding", "lake", "member", "message", "phone", "scene", "appearance", "association", "concept", "customer", "death", "discussion", "housing", "inflation", "insurance", "mood", "woman", "advice", "blood", "effort", "expression", "importance", "opinion", "payment", "reality", "responsibility", "situation", "skill", "statement", "wealth", "application", "city", "county", "depth", "estate", "foundation", "grandmother", "heart", "perspective", "photo", "recipe", "studio", "topic", "collection", "depression", "imagination", "passion", "percentage", "resource", "setting", "ad", "agency", "college", "connection", "criticism", "debt", "description", "memory", "patience", "secretary", "solution", "administration", "aspect", "attitude", "director", "personality", "psychology", "recommendation", "response", "selection", "storage", "version", "alcohol", "argument", "complaint", "contract", "emphasis", "highway", "loss", "membership", "possession", "preparation", "steak", "union", "agreement", "cancer", "currency", "employment", "engineering", "entry", "interaction", "limit", "mixture", "preference", "region", "republic", "seat", "tradition", "virus", "actor", "classroom", "delivery", "device", "difficulty", "drama", "election", "engine", "football", "guidance", "hotel", "match", "owner", "priority", "protection", "suggestion", "tension", "variation", "anxiety", "atmosphere", "awareness", "bread", "climate", "comparison", "confusion", "construction", "elevator", "emotion", "employee", "employer", "guest", "height", "leadership", "mall", "manager", "operation", "recording", "respect", "sample", "transportation", "boring", "charity", "cousin", "disaster", "editor", "efficiency", "excitement", "extent", "feedback", "guitar", "homework", "leader", "mom", "outcome", "permission", "presentation", "promotion", "reflection", "refrigerator", "resolution", "revenue", "session", "singer", "tennis", "basket", "bonus", "cabinet", "childhood", "church", "clothes", "coffee", "dinner", "drawing", "hair", "hearing", "initiative", "judgment", "lab", "measurement", "mode", "mud", "orange", "poetry", "police", "possibility", "procedure", "queen", "ratio", "relation", "restaurant", "satisfaction", "sector", "signature", "significance", "song", "tooth", "town", "vehicle", "volume", "wife", "accident", "airport", "appointment", "arrival", "assumption", "baseball", "chapter", "committee", "conversation", "database", "enthusiasm", "error", "explanation", "farmer", "gate", "girl", "hall", "historian", "hospital", "injury", "instruction", "maintenance", "manufacturer", "meal", "perception", "pie", "poem", "presence", "proposal", "reception", "replacement", "revolution", "river", "son", "speech", "tea", "village", "warning", "winner", "worker", "writer", "assistance", "breath", "buyer", "chest", "chocolate", "conclusion", "contribution", "cookie", "courage", "desk", "drawer", "establishment", "examination", "garbage", "grocery", "honey", "impression", "improvement", "independence", "insect", "inspection", "inspector", "king", "ladder", "menu", "penalty", "piano", "potato", "profession", "professor", "quantity", "reaction", "requirement", "salad", "sister", "supermarket", "tongue", "weakness", "wedding", "affair", "ambition", "analyst", "apple", "assignment", "assistant", "bathroom", "bedroom", "beer", "birthday", "celebration", "championship", "cheek", "client", "consequence", "departure", "diamond", "dirt", "ear", "fortune", "friendship", "funeral", "gene", "girlfriend", "hat", "indication", "intention", "lady", "midnight", "negotiation", "obligation", "passenger", "pizza", "platform", "poet", "pollution", "recognition", "reputation", "shirt", "speaker", "stranger", "surgery", "sympathy", "tale", "throat", "trainer", "uncle", "youth", "time", "work", "film", "water", "money", "example", "while", "business", "study", "game", "life", "form", "air", "day", "place", "number", "part", "field", "fish", "back", "process", "heat", "hand", "experience", "job", "book", "end", "point", "type", "home", "economy", "value", "body", "market", "guide", "interest", "state", "radio", "course", "company", "price", "size", "card", "list", "mind", "trade", "line", "care", "group", "risk", "word", "fat", "force", "key", "light", "training", "name", "school", "top", "amount", "level", "order", "practice", "research", "sense", "service", "piece", "web", "boss", "sport", "fun", "house", "page", "term", "test", "answer", "sound", "focus", "matter", "kind", "soil", "board", "oil", "picture", "access", "garden", "range", "rate", "reason", "future", "site", "demand", "exercise", "image", "case", "cause", "coast", "action", "age", "bad", "boat", "record", "result", "section", "building", "mouse", "cash", "class", "period", "plan", "store", "tax", "side", "subject", "space", "rule", "stock", "weather", "chance", "figure", "man", "model", "source", "beginning", "earth", "program", "chicken", "design", "feature", "head", "material", "purpose", "question", "rock", "salt", "act", "birth", "car", "dog", "object", "scale", "sun", "note", "profit", "rent", "speed", "style", "war", "bank", "craft", "half", "inside", "outside", "standard", "bus", "exchange", "eye", "fire", "position", "pressure", "stress", "advantage", "benefit", "box", "frame", "issue", "step", "cycle", "face", "item", "metal", "paint", "review", "room", "screen", "structure", "view", "account", "ball", "discipline", "medium", "share", "balance", "bit", "black", "bottom", "choice", "gift", "impact", "machine", "shape", "tool", "wind", "address", "average", "career", "culture", "morning", "pot", "sign", "table", "task", "condition", "contact", "credit", "egg", "hope", "ice", "network", "north", "square", "attempt", "date", "effect", "link", "post", "star", "voice", "capital", "challenge", "friend", "self", "shot", "brush", "couple", "exit", "front", "function", "lack", "living", "plant", "plastic", "spot", "summer", "taste", "theme", "track", "wing", "brain", "button", "click", "desire", "foot", "gas", "influence", "notice", "rain", "wall", "base", "damage", "distance", "feeling", "pair", "savings", "staff", "sugar", "target", "text", "animal", "author", "budget", "discount", "file", "ground", "lesson", "minute", "officer", "phase", "reference", "register", "sky", "stage", "stick", "title", "trouble", "bowl", "bridge", "campaign", "character", "club", "edge", "evidence", "fan", "letter", "lock", "maximum", "novel", "option", "pack", "park", "quarter", "skin", "sort", "weight", "baby", "background", "carry", "dish", "factor", "fruit", "glass", "joint", "master", "muscle", "red", "strength", "traffic", "trip", "vegetable", "appeal", "chart", "gear", "ideal", "kitchen", "land", "log", "mother", "net", "party", "principle", "relative", "sale", "season", "signal", "spirit", "street", "tree", "wave", "belt", "bench", "commission", "copy", "drop", "minimum", "path", "progress", "project", "sea", "south", "status", "stuff", "ticket", "tour", "angle", "blue", "breakfast", "confidence", "daughter", "degree", "doctor", "dot", "dream", "duty", "essay", "father", "fee", "finance", "hour", "juice", "luck", "milk", "mouth", "peace", "pipe", "stable", "storm", "substance", "team", "trick", "afternoon", "bat", "beach", "blank", "catch", "chain", "consideration", "cream", "crew", "detail", "gold", "interview", "kid", "mark", "mission", "pain", "pleasure", "score", "screw", "sex", "shop", "shower", "suit", "tone", "window", "agent", "band", "bath", "block", "bone", "calendar", "candidate", "cap", "coat", "contest", "corner", "court", "cup", "district", "door", "east", "finger", "garage", "guarantee", "hole", "hook", "implement", "layer", "lecture", "lie", "manner", "meeting", "nose", "parking", "partner", "profile", "rice", "routine", "schedule", "swimming", "telephone", "tip", "winter", "airline", "bag", "battle", "bed", "bill", "bother", "cake", "code", "curve", "designer", "dimension", "dress", "ease", "emergency", "evening", "extension", "farm", "fight", "gap", "grade", "holiday", "horror", "horse", "host", "husband", "loan", "mistake", "mountain", "nail", "noise", "occasion", "package", "patient", "pause", "phrase", "proof", "race", "relief", "sand", "sentence", "shoulder", "smoke", "stomach", "string", "tourist", "towel", "vacation", "west", "wheel", "wine", "arm", "aside", "associate", "bet", "blow", "border", "branch", "breast", "brother", "buddy", "bunch", "chip", "coach", "cross", "document", "draft", "dust", "expert", "floor", "god", "golf", "habit", "iron", "judge", "knife", "landscape", "league", "mail", "mess", "native", "opening", "parent", "pattern", "pin", "pool", "pound", "request", "salary", "shame", "shelter", "shoe", "silver", "tackle", "tank", "trust", "assist", "bake", "bar", "bell", "bike", "blame", "boy", "brick", "chair", "closet", "clue", "collar", "comment", "conference", "devil", "diet", "fear", "fuel", "glove", "jacket", "lunch", "monitor", "mortgage", "nurse", "pace", "panic", "peak", "plane", "reward", "row", "sandwich", "shock", "spite", "spray", "surprise", "till", "transition", "weekend", "welcome", "yard", "alarm", "bend", "bicycle", "bite", "blind", "bottle", "cable", "candle", "clerk", "cloud", "concert", "counter", "flower", "grandfather", "harm", "knee", "lawyer", "leather", "load", "mirror", "neck", "pension", "plate", "purple", "ruin", "ship", "skirt", "slice", "snow", "specialist", "stroke", "switch", "trash", "tune", "zone", "anger", "award", "bid", "bitter", "boot", "bug", "camp", "candy", "carpet", "cat", "champion", "channel", "clock", "comfort", "cow", "crack", "engineer", "entrance", "fault", "grass", "guy", "hell", "highlight", "incident", "island", "joke", "jury", "leg", "lip", "mate", "motor", "nerve", "passage", "pen", "pride", "priest", "prize", "promise", "resident", "resort", "ring", "roof", "rope", "sail", "scheme", "script", "sock", "station", "toe", "tower", "truck", "witness", "can", "will", "other", "use", "make", "good", "look", "help", "go", "great", "being", "still", "public", "read", "keep", "start", "give", "human", "local", "general", "specific", "long", "play", "feel", "high", "put", "common", "set", "change", "simple", "past", "big", "possible", "particular", "major", "personal", "current", "national", "cut", "natural", "physical", "show", "try", "check", "second", "call", "move", "pay", "let", "increase", "single", "individual", "turn", "ask", "buy", "guard", "hold", "main", "offer", "potential", "professional", "international", "travel", "cook", "alternative", "special", "working", "whole", "dance", "excuse", "cold", "commercial", "low", "purchase", "deal", "primary", "worth", "fall", "necessary", "positive", "produce", "search", "present", "spend", "talk", "creative", "tell", "cost", "drive", "green", "support", "glad", "remove", "return", "run", "complex", "due", "effective", "middle", "regular", "reserve", "independent", "leave", "original", "reach", "rest", "serve", "watch", "beautiful", "charge", "active", "break", "negative", "safe", "stay", "visit", "visual", "affect", "cover", "report", "rise", "walk", "white", "junior", "pick", "unique", "classic", "final", "lift", "mix", "private", "stop", "teach", "western", "concern", "familiar", "fly", "official", "broad", "comfortable", "gain", "rich", "save", "stand", "young", "heavy", "lead", "listen", "valuable", "worry", "handle", "leading", "meet", "release", "sell", "finish", "normal", "press", "ride", "secret", "spread", "spring", "tough", "wait", "brown", "deep", "display", "flow", "hit", "objective", "shoot", "touch", "cancel", "chemical", "cry", "dump", "extreme", "push", "conflict", "eat", "fill", "formal", "jump", "kick", "opposite", "pass", "pitch", "remote", "total", "treat", "vast", "abuse", "beat", "burn", "deposit", "print", "raise", "sleep", "somewhere", "advance", "consist", "dark", "double", "draw", "equal", "fix", "hire", "internal", "join", "kill", "sensitive", "tap", "win", "attack", "claim", "constant", "drag", "drink", "guess", "minor", "pull", "raw", "soft", "solid", "wear", "weird", "wonder", "annual", "count", "dead", "doubt", "feed", "forever", "impress", "repeat", "round", "sing", "slide", "strip", "wish", "combine", "command", "dig", "divide", "equivalent", "hang", "hunt", "initial", "march", "mention", "spiritual", "survey", "tie", "adult", "brief", "crazy", "escape", "gather", "hate", "prior", "repair", "rough", "sad", "scratch", "sick", "strike", "employ", "external", "hurt", "illegal", "laugh", "lay", "mobile", "nasty", "ordinary", "respond", "royal", "senior", "split", "strain", "struggle", "swim", "train", "upper", "wash", "yellow", "convert", "crash", "dependent", "fold", "funny", "grab", "hide", "miss", "permit", "quote", "recover", "resolve", "roll", "sink", "slip", "spare", "suspect", "sweet", "swing", "twist", "upstairs", "usual", "abroad", "brave", "calm", "concentrate", "estimate", "grand", "male", "mine", "prompt", "quiet", "refuse", "regret", "reveal", "rush", "shake", "shift", "shine", "steal", "suck", "surround", "bear", "brilliant", "dare", "dear", "delay", "drunk", "female", "hurry", "inevitable", "invite", "kiss", "neat", "pop", "punch", "quit", "reply", "representative", "resist", "rip", "rub", "silly", "smile", "spell", "stretch", "stupid", "tear", "temporary", "tomorrow", "wake", "wrap", "yesterday", "Thomas", "Tom", "Lieuwe"];

    if (capitalize) {
        return capFirst(name1[getRandomInt(0, name1.length + 1)]) + ' ' + capFirst(name2[getRandomInt(0, name2.length + 1)]);
    }
    return name1[getRandomInt(0, name1.length + 1)] + ' ' + name2[getRandomInt(0, name2.length + 1)];
}
