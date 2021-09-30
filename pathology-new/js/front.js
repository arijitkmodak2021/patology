'use strict';

document.addEventListener('DOMContentLoaded', function () {

    // ------------------------------------------------------- //
    // Search Box
    // ------------------------------------------------------ //
    const navBar = document.querySelector('.navbar');
    //const searchBtn = document.getElementById('search'),
    //      searchBox = document.querySelector('.search-box'),
    //      searchClose = document.querySelector('.dismiss');

    //if (navBar) {
    //    searchBtn.addEventListener('click', (e) => {
    //        e.preventDefault();
    //        searchBox.classList.add('fadedIn');
    //    });
    //
    //    searchClose.addEventListener('click', () => searchBox.classList.remove('fadedIn'));
    //}



    // ------------------------------------------------------- //
    // Card Close
    // ------------------------------------------------------ //
    const closeCardBtn = document.querySelectorAll('.card-close a.remove');
    closeCardBtn.forEach((el) => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            el.closest('.card').style.opacity = '0';
            setTimeout(function () { el.closest('.card').classList.add('d-none'); }, 300);
        });
    });


    // ------------------------------------------------------- //
    // Card Close dropdown
    // ------------------------------------------------------ //
    const cardSettingsToggle = document.querySelectorAll('.card-close .dropdown-toggle');
    cardSettingsToggle.forEach((el) => {
        el.addEventListener('click', () => {
            if (el.classList.contains('show')) {
                setTimeout(function () { el.nextElementSibling.classList.add('is-visible'); }, 100);
            }
        });
    });

    document.addEventListener('click', function (e) {
        cardSettingsToggle.forEach((el) => {
            if (e.target == el) {
                setTimeout(function () { el.nextElementSibling.classList.add('is-visible'); }, 100);
            } else {
                el.nextElementSibling.classList.remove('is-visible');
            }
        });
    });





    // ------------------------------------------------------- //
    // Tooltips init
    // ------------------------------------------------------ //
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });



    // ------------------------------------------------------- //
    // Sidebar Functionality
    // ------------------------------------------------------ //
    const sbToggleBtn = document.getElementById('toggle-btn'),
          sideNavbar  = document.querySelector('.side-navbar'),
          innerContent = document.querySelector('.content-inner'),
          smBrand = document.querySelector('.navbar-header .brand-small'),
          lgBrand = document.querySelector('.navbar-header .brand-big');

    if (sideNavbar) {
        sbToggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            this.classList.toggle('active');

            sideNavbar.classList.toggle('shrinked');
            innerContent.classList.toggle('active');
            document.dispatchEvent(new Event('sidebarChanged'));

            /* THIS IS NOT THERE ANY MORE [UTILITY CLASSES USED] */

            // if (window.outerWidth > 1183) {
            //     if (sbToggleBtn.classList.contains('active')) {
            //         smBrand.style.display = 'none';
            //         lgBrand.style.display = 'block';
            //     } else {
            //         smBrand.style.display = 'block';
            //         lgBrand.style.display = 'none';
            //     }
            // }
            //
            // if (window.outerWidth < 1183) {
            //     smBrand.style.display = 'block';
            // }
        });
    }




    // ------------------------------------------------------- //
    // Footer
    // ------------------------------------------------------ //
    let footer = document.querySelector('#footer');
    if (footer) {
        document.addEventListener('sidebarChanged', function () {
            adjustFooter();
        });
        window.addEventListener('resize', function () {
            adjustFooter();
        });
    }

    function adjustFooter() {
        var footerBlockHeight = document.querySelector('#footer').outerHeight;
        innerContent.style.paddingBottom = `${footerBlockHeight}px`;
    }



    // ------------------------------------------------------- //
    // External links to new window
    // ------------------------------------------------------ //
    document.querySelectorAll('.external').forEach((el) => {
        el.addEventListener('click', function (e) {
            e.preventDefault();
            window.open(el.getAttribute('href'));
        });
    });


    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    let materialInputs = document.querySelectorAll('input.input-material');
    let materialLabel = document.querySelectorAll('label.label-material');

    // activate labels for prefilled values
    let filledMaterialInputs = Array.from(materialInputs).filter(function (input) {
        return input.value !== '';
    });
    filledMaterialInputs.forEach(input => input.parentElement.lastElementChild.setAttribute('class', 'label-material active'));

    // move label on focus
    materialInputs.forEach((input) => {
        input.addEventListener('focus', function () {
            input.parentElement.lastElementChild.setAttribute('class', 'label-material active');
        });
    });

    // remove/keep label on blur
    materialInputs.forEach((input) => {
        input.addEventListener('blur', function () {
            if (input.value !== '') {
                input.parentElement.lastElementChild.setAttribute('class', 'label-material active');
            } else {
                input.parentElement.lastElementChild.setAttribute('class', 'label-material');
            }
        });
    });


    function bsValidationBehavior(errorInputs, form) {
        function watchError() {
            errorInputs.forEach((input) => {
                if (input.classList.contains('js-validate-error-field')) {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
            });
        }
        watchError();
    }

    // ------------------------------------------------------- //
    // Login Form Validation
    // ------------------------------------------------------ //
    let loginForm = document.querySelector('.login-form');
    if (loginForm) {
        new window.JustValidate('.login-form', {
            rules: {
                loginUsername: {
                    required: true,
                },
                loginPassword: {
                    required: true,
                },
            },
            messages: {
                loginUsername: 'Please enter your username',
                loginPassword: 'Please enter your password'
            },
            invalidFormCallback: function () {
                let errorInputs = document.querySelectorAll('.login-form input[required]');
                bsValidationBehavior(errorInputs, loginForm);
                loginForm.addEventListener('keyup', () => bsValidationBehavior(errorInputs, loginForm))
            },
        });
    }
    
	// ------------------------------------------------------- //
	// Login Form Validation
	// ------------------------------------------------------ //
	let search_patientForm = document.querySelector('.search_patient');
	if (search_patientForm) {
		new window.JustValidate('.search_patient', {
			rules: {
				patient_id: {
				    required: true,
				}
			},
			messages: {
				patient_id: 'Please enter Patient Id',
			},
			invalidFormCallback: function () {
				let errorInputs = document.querySelectorAll('.search_patient input[required]');
				bsValidationBehavior(errorInputs, search_patientForm);
				search_patientForm.addEventListener('keyup', () => bsValidationBehavior(errorInputs, search_patientForm))
			},
		});
	}
    
	// ------------------------------------------------------- //
	// Login Form Validation
	// ------------------------------------------------------ //
	let patientRegisterForm = document.querySelector('.patient_register_form');
	if (patientRegisterForm) {
		new window.JustValidate('.patient_register_form', {
			rules: {
				serial_no: {
					required: true,
				},
				patient_name: {
				    required: true,
				},
				patient_age: {
				    required: true,
				    number: true
				},
				mobile_no: {
				    required: true,
				    number: true
				},
				gender_val: {
				    required: true,
				},
				word_no_val: {
				    required: true,
				},
				docotor_name: {
					required: true,
				}
			},
			messages: {
				serial_no: 'Please enter serial no.',
				patient_name: 'Please enter patient\' name.',
				patient_age: 'Please enter patient\'s age.',
				mobile_no: 'Please enter mobile no.',
				gender_val: 'Please select gender.',
				word_no_val: 'Please select word no.',
				docotor_name: 'Please select doctor.',
				
			},
			invalidFormCallback: function () {
				let errorInputs = document.querySelectorAll('.patient_register_form input[required]');
				bsValidationBehavior(errorInputs, patientRegisterForm);
				patientRegisterForm.addEventListener('keyup', () => bsValidationBehavior(errorInputs, patientRegisterForm))
			},
		});
	}

    // ------------------------------------------------------- //
    // test type create Form Validation 
    // ------------------------------------------------------ //
    let typeForm = document.querySelector('.test_type_create');
    if (typeForm) {
        new window.JustValidate('.test_type_create', {
            rules: {
                cat_id: {
                    required: true,
                },
                //category_name: {
                //    required: function(element){
                //        return ($("#create_new").val() == 1) ? true : false;
                //    }
                //},
                type_name: {
                    required: true,
                },
                unit: {
                    required: true,
                },
                normal_range: {
                    required: true,
                }
            },
            messages: {
                cat_id: 'Please select a  category.',
                category_name: 'Please enter category name.',
                type_name: 'Please enter test type name.',
                unit: 'Please enter unit value.',
                normal_range: 'Please enter normal range value.'
            },
            invalidFormCallback: function () {
                let errorInputs = document.querySelectorAll('.test_type_create input[required]');
                bsValidationBehavior(errorInputs, typeForm);
                typeForm.addEventListener('keyup', () => bsValidationBehavior(errorInputs, typeForm))
            },
        });
    }



    // ------------------------------------------------------- //
    // Register Form Validation
    // ------------------------------------------------------ //
    let registerForm = document.querySelector('.register-form');
    if (registerForm) {
        new window.JustValidate('.register-form', {
            rules: {
                registerUsername: {
                    required: true
                },
                registerEmail: {
                    required: true,
                    email: true
                },
                registerPassword: {
                    required: true,
                },
                registerAgree: {
                    required: true,
                },
            },
            messages: {
                registerUsername: 'Please enter your username',
                registerEmail: 'Please enter a valid email address',
                registerPassword: 'Please enter your password',
                registerAgree: 'Your agreement is required'
            },
            invalidFormCallback: function () {
                let errorInputs = document.querySelectorAll('.register-form input[required]');
                bsValidationBehavior(errorInputs, registerForm);
                registerForm.addEventListener('keyup', () => bsValidationBehavior(errorInputs, registerForm))
                registerForm.addEventListener('change', () => bsValidationBehavior(errorInputs, registerForm))
            },
        });
    }


    // ------------------------------------------------------- //
    // Profile page choices
    // ------------------------------------------------------ //
    function injectClassess(x) {
        let pickerCustomClass = x.dataset.customclass;
        let pickerSevClasses = pickerCustomClass.split(' ');
        x.parentElement.classList.add.apply(x.parentElement.classList, pickerSevClasses);
    }

    const profileCountryChoices = document.querySelector('.profile-country-choices');
    if (profileCountryChoices) {
        const countryChoices = new Choices(profileCountryChoices, {
            searchEnabled: false,
            placeholder: false,
            callbackOnInit: () => injectClassess(profileCountryChoices)
        });
    }


});
