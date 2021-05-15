function autoWriteText() {
	let index = 0;
	const text = 'La victoire ne s’arrête pas à la ligne d’arrivée.';
	let myVar = setInterval(writeText, 100);

	function writeText() {
		document.getElementById('textIndex').innerText = text.slice(0, index);

		index++;
	}

	setInterval(writeText, 100);
	clearInterval(myVar);
}

function login() {
	const myForm = document.getElementById('myForm');

	myForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const formData = new FormData(this);
		const searchParams = new URLSearchParams();

		for (const pair of formData) {
			searchParams.append(pair[0], pair[1]);
		}
		console.log(searchParams);

		fetch('../app/login_exec.php', {
			method: 'post', // La méthode ( POST = DONNE DONNE ET GET = DONNE PRISE ),
			body: searchParams, // C'EST MON EMAIL ET MP QUI A ETE PRIS GRACE AU FORMDATA ET REMODELER
		})
			.then(response => {
				// LA REPONSE LA FAMEUSE
				if (response.ok) return response.json(); // SI ELLE EST OK ALORS ON RETOURNE JSON
			})
			.then(json => {
				return json.status;
			})
			.then(status => {
				console.log(status);
				if (status === true) {
					document.location.href = 'myAccount.php';
				} else {
					document.getElementById('messageStatus').innerHTML =
						'La combinaison email / mot de passe est incorrect';
					document.getElementById('messageStatus').classList.remove('none');
				}
			});
	});
}

function register() {
	const myForm = document.getElementById('myForm');
	myForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const formData = new FormData(this);
		const searchParams = new URLSearchParams();

		for (const pair of formData) {
			searchParams.append(pair[0], pair[1]);
		}

		fetch('../app/register_exec.php', {
			method: 'post', // La méthode ( POST = DONNE DONNE ET GET = DONNE PRISE ),
			body: searchParams, // C'EST MON EMAIL ET MP QUI A ETE PRIS GRACE AU FORMDATA ET REMODELER
		})
			.then(response => {
				// LA REPONSE LA FAMEUSE
				if (response.ok) return response.json(); // SI ELLE EST OK ALORS ON RETOURNE JSON
			})
			.then(json => {
				if (checkFormRegister()) {
					console.log('Pastout');
				} else {
					if (json.status == 'Compte creer') {
						document.location.href = 'login.php';
					}
					if (json.status == 'Email déjà utilisée') {
						email.style.border = '1px solid #f10909';
						document.getElementById('messageStatus').innerHTML =
							'<p>Désolé, votre email est déjà utilisée !</p>';
						document.getElementById('messageStatus').classList.remove('none');
					}
					if (json.status == 'Mot de passe incorrect') {
						password.style.border = '1px solid #f10909';
						document.getElementById('password').style.border =
							'1px solid #f10909';
						document.getElementById(
							'messageStatus',
						).innerHTML = `<p>Votre mot de passe doit contenir minimum 12 caractères et contenir au moins  une majuscule, minuscule, des chiffres et caractère spéciaux.<br>
                            (Indice ${json.data.indPass} / 250)</p>`;
						document.getElementById('messageStatus').classList.remove('none');
					}
					if (json.status == 'Empty') {
						document.getElementById('messageStatus').innerHTML =
							'</p>Remplissez tout les champs.</p>';
						document.getElementById('messageStatus').classList.remove('none');
					}
				}
			});
	});
}

function eventRegister() {
	const myForm = document.getElementById('formEventRegister');
	myForm.addEventListener('submit', function (e) {
		e.preventDefault();
		const formData = new FormData(this);
		const searchParams = new URLSearchParams();

		for (const pair of formData) {
			searchParams.append(pair[0], pair[1]);
		}
		if (checkFormEventRegister()) {
			if (checkFormEventRegister() === 'nlicence') {
				messageStatus.innerHTML = `<p >Numéro de licence invalide ( 10 à 12 chiffres ).</p>
                                            <p >Merci de remplir toutes les informations correctement.</p>`;
			} else {
				messageStatus.innerHTML =
					'<p >Merci de remplir toutes les informations correctement.</p>';
			}
			messageStatus.classList.remove('none');
		} else {
			fetch('../app/createInscrire.php', {
				method: 'post', // La méthode ( POST = DONNE DONNE ET GET = DONNE PRISE ),
				body: searchParams, // C'EST MON EMAIL ET MP QUI A ETE PRIS GRACE AU FORMDATA ET REMODELER
			})
				.then(response => {
					// LA REPONSE LA FAMEUSE
					if (response.ok) return response.json(); // SI ELLE EST OK ALORS ON RETOURNE JSON
				})
				.then(json => {
					if (json.status == 'ok') {
						textOK = `
						<h1>Confirmation d'Inscription pour l'épreuve ${json.data.epreuveNom}</h1>
						<h3>Bonjour ${json.data.prenom} :) </h3>
																		<h4>
																		Date de l'épreuve : ${json.data.epreuveDate}<br>
																		Lieu de l'épreuve : ${json.data.epreuveLieu}<br>
																		Votre numéro de dossard : ${json.data.dossard}<br>
																		Votre numéro de coureur pour cette épreuve : ${json.data.insID}<br>
																		</h4>
																		<h4>Vous recevrez prochainement un email afin de valider votre présence ! A bientot cher coureur :)</h4>
																		<h3>Si vous souhaitez autoriser vos droits l'image et/ou à la voix merci de bien vouloir nous envoyez ces documents signés a l'adresse email loyal@runninghightec.fr afin d'utiliser votre voix / image. </h3>
																		<div style="display:flex;flex-direction:row;justify-content:center;align-items:center;">
																		<a href='/assets/pdf/consentementDroitVoixVierge.pdf'target="_blank">Droit à la voix </a>
																		<a href='/assets/pdf/consentementDroitImageVierge.pdf'target="_blank">Droit à l'image </a>
																		</div>
                        `;
						document.getElementById('s14').style.background = 'none';
						document.getElementById('formEventRegister').style.display = 'none';
						document.getElementById('messageS').innerHTML = textOK;
					}
					if (json.status == 'epreuve') {
						document.getElementById('messageStatus').innerHTML =
							"<p >L'épreuve sélectionnée n'est pas disponible.</p>";
						document.getElementById('messageStatus').classList.remove('none');
						document.getElementById('typeEpreuve').style.border =
							'1px solid #f10909';
					}
					if (json.status == 'licence') {
						document.getElementById('messageStatus').innerHTML =
							'<p >Un coureur avec ce numéro de licence est déjà existant. </p>';
						document.getElementById('messageStatus').classList.remove('none');
						nlicence.style.border = '1px solid #f10909';
					}
					if (json.status == 'Empty') {
						document.getElementById('messageStatus').innerHTML =
							'<p >Merci de remplir toutes les informations.</p>';
						document.getElementById('messageStatus').classList.remove('none');
					}
				});
		}
	});
}

function checkFormEventRegister() {
	let erreur;
	let nom = document.getElementById('nom');
	let prenom = document.getElementById('prenom');
	let dnaissance = document.getElementById('dnaissance');
	let nlicence = document.getElementById('nlicence');
	let cage = document.getElementById('age');
	let epreuve = document.getElementById('typeEpreuve');
	let tmaillot = document.getElementById('tailleMaillot');
	let tannonce = document.getElementById('tannonce');
	let nationalite = document.getElementById('nationalite');
	const checkboxtier = document.getElementById('checkboxtier');
	const checkboxpro = document.getElementById('checkboxpro');
	if (!nom.value) {
		nom.style.border = '1px solid #f10909';
		erreur = 'nom';
	} else {
		nom.style = '';
	}

	if (!prenom.value) {
		prenom.style.border = '1px solid #f10909';
		erreur = 'nom';
	} else {
		prenom.style = '';
	}

	if (!prenom.value) {
		prenom.style.border = '1px solid #f10909';
		erreur = 'prenom';
	} else {
		prenom.style = '';
	}

	if (!dnaissance.value) {
		dnaissance.style.border = '1px solid #f10909';
		erreur = 'dnaissance';
	} else {
		dnaissance.style = '';
	}

	if (!cage.value) {
		cage.style.border = '1px solid #f10909';
		erreur = 'cage';
	} else {
		cage.style = '';
	}

	if (!epreuve.value) {
		epreuve.style.border = '1px solid #f10909';
		erreur = 'epreuve';
	} else {
		epreuve.style = '';
	}

	if (!tannonce.value) {
		tannonce.style.border = '1px solid #f10909';
		erreur = 'tannonce';
	} else {
		tannonce.style = '';
	}

	if (!epreuve.value) {
		epreuve.style.border = '1px solid #f10909';
		erreur = 'epreuve';
	} else {
		epreuve.style = '';
	}
	if (checkboxtier.checked) {
		let tierEmail = document.getElementById('tierEmail');
		let tierAdresse = document.getElementById('tierAdresse');
		let tierTel = document.getElementById('tierTel');

		if (!tierEmail.value) {
			tierEmail.style.border = '1px solid #f10909';
			erreur = 'tierEmail';
		} else {
			tierEmail.style = '';
		}

		if (!tierAdresse.value) {
			tierAdresse.style.border = '1px solid #f10909';
			erreur = 'tierAdresse';
		} else {
			tierAdresse.style = '';
		}

		if (!tierTel.value) {
			tierTel.style.border = '1px solid #f10909';
			erreur = 'tierTel';
		} else {
			tierTel.style = '';
		}
	}
	if (checkboxpro.checked) {
		let proDC = document.getElementById('proDC');
		let proFC = document.getElementById('proFC');
		let proMC = document.getElementById('proMC');

		if (!proDC.value) {
			proDC.style.border = '1px solid #f10909';
			erreur = 'proDC';
		} else {
			proDC.style = '';
		}

		if (!proFC.value) {
			proFC.style.border = '1px solid #f10909';
			erreur = 'proFC';
		} else {
			proFC.style = '';
		}

		if (!proMC.value) {
			proMC.style.border = '1px solid #f10909';
			erreur = 'proMC';
		} else {
			proMC.style = '';
		}
	}
	if (
		!nlicence.value ||
		nlicence.value.length > 12 ||
		nlicence.value.length < 10
	) {
		nlicence.style.border = '1px solid #f10909';
		erreur = 'nlicence';
	} else {
		nlicence.style = '';
	}

	return erreur;
}
function checkFormRegister() {
	let erreur;
	let nom = document.getElementById('nom');
	let prenom = document.getElementById('prenom');
	let adresse = document.getElementById('adresse');
	let email = document.getElementById('email');
	let tel = document.getElementById('tel');
	let password = document.getElementById('password');
	if (!nom.value) {
		nom.style.border = '1px solid #f10909';
		erreur = 'nom';
	} else {
		nom.style = '';
	}

	if (!prenom.value) {
		prenom.style.border = '1px solid #f10909';
		erreur = 'nom';
	} else {
		prenom.style = '';
	}

	if (!adresse.value) {
		adresse.style.border = '1px solid #f10909';
		erreur = 'adresse';
	} else {
		adresse.style = '';
	}

	if (!email.value) {
		email.style.border = '1px solid #f10909';
		erreur = 'email';
	} else {
		email.style = '';
	}

	if (!tel.value) {
		tel.style.border = '1px solid #f10909';
		erreur = 'tel';
	} else {
		tel.style = '';
	}

	if (!password.value) {
		password.style.border = '1px solid #f10909';
		erreur = 'password';
	} else {
		password.style = '';
	}

	return erreur;
}
