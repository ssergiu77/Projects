window.localStorage.setItem('aLibrary', JSON.stringify([]));
window.localStorage.setItem('bLibrary', JSON.stringify([]));
window.localStorage.setItem('abLibrary', JSON.stringify([]));

var aLibrary = JSON.parse(localStorage.getItem('aLibrary'));
var bLibrary = JSON.parse(localStorage.getItem('bLibrary'));
var abLibrary = JSON.parse(localStorage.getItem('abLibrary'));
var idAutor = 0;

var container = document.getElementById('pagina');

var addBook = document.createElement('button');
addBook.className = "btn btn-primary";
addBook.innerHTML = "Adauga Cartea";
addBook.onclick = function () {showBookFields();}
container.appendChild(addBook);

var addAutor = document.createElement('button');
addAutor.className = "btn btn-primary";
addAutor.innerHTML = "Adauga Autor";
addAutor.onclick = function () {showAutorFields();}
container.appendChild(addAutor);

var addLibrary = document.createElement('button');
addLibrary.className = "btn btn-primary";
addLibrary.innerHTML = "Arata Libraria";
addLibrary.onclick = function () {showLibrary();}
container.appendChild(addLibrary);

// Fielduri carte

var divBook = document.createElement('div');
divBook.id = 'divBook';
// container.appendChild(divBook);

var bnameField = document.createElement('div')
bnameField.id = 'bnameField';
bnameField.className = 'form-floating';
divBook.appendChild(bnameField);

var bnameInput = document.createElement('textarea');
bnameInput.className = "form-control";
bnameInput.id = "floatingTextarea";
bnameInput.placeholder = "Scrie numele cartii";
bnameField.appendChild(bnameInput);

var bnameLable = document.createElement('label');
bnameLable.setAttribute('for', 'floatingTextarea');
bnameLable.innerHTML = "Scrie numele cartii";
bnameField.appendChild(bnameLable);

var bedituraField = document.createElement('div');
bedituraField.id = "bedituraField";
bedituraField.className = 'form-floating';
divBook.appendChild(bedituraField);

var bedituraInput = document.createElement('textarea');
bedituraInput.className = "form-control";
bedituraInput.placeholder = "Scrie editura cartii.";
bedituraInput.id = "floatingTextarea";
bedituraField.appendChild(bedituraInput);

var bedituraLabel = document.createElement('label');
bedituraLabel.setAttribute("for", "floatingTextarea");
bedituraLabel.innerHTML = "Scrie editura cartii.";
bedituraField.appendChild(bedituraLabel);

var bdataField = document.createElement('div')
bdataField.id = 'bdataField';
bdataField.className = 'form-floating';
divBook.appendChild(bdataField);

var bdataInput = document.createElement('textarea');
bdataInput.className = "form-control";
bdataInput.placeholder = "Scrie data publicarii.";
bdataInput.id = "floatingTextarea";
bdataField.appendChild(bdataInput);

var bdataLabel = document.createElement('label');
bdataLabel.setAttribute("for", "floatingTextarea");
bdataLabel.innerHTML = "Scrie data publicarii.";
bdataField.appendChild(bdataLabel);

var divSelector = document.createElement('div')
divSelector.id = "divSelector-book";
divBook.appendChild(divSelector);

var aSelector = document.createElement('select');
aSelector.id = "afield-selector";
aSelector.name = "autorSelect";
aSelector.className = "form-select";
aSelector.onchange = function () {showNoAutorExist();}
divSelector.appendChild(aSelector);

var option = document.createElement('option');
option.value;
option.text;
aSelector.append(option);

var nuexAutor = document.createElement('option');
nuexAutor.value = "noexautor";
nuexAutor.text = "Nu exista autor";
aSelector.append(nuexAutor);

var autorNameField = document.createElement('div');
autorNameField.id = "autorNameField";
autorNameField.className = 'form-floating';
divBook.appendChild(autorNameField);

var anameInput = document.createElement('textarea');
anameInput.className = "form-control";
anameInput.placeholder = "Scrie numele autorului.";
anameInput.id = "floatingTextarea";
autorNameField.appendChild(anameInput);

var anameLabel = document.createElement('label');
anameLabel.setAttribute("for", "floatingTextarea");
anameLabel.innerHTML = "Scrie numele autorului.";
autorNameField.appendChild(anameLabel);

var autorVarstaField = document.createElement('div');
autorVarstaField.id = "autorVarstaField";
autorVarstaField.className = 'form-floating';
divBook.appendChild(autorVarstaField)

var avarstaInput = document.createElement('textarea');
avarstaInput.className = "form-control";
avarstaInput.placeholder = "Scrie data nasterii a autorului.";
avarstaInput.id = "floatingTextarea";
autorVarstaField.appendChild(avarstaInput);

var avarstaLabel = document.createElement('label');
avarstaLabel.setAttribute('for', 'floatingTextarea');
avarstaLabel.innerHTML = "Scrie data nasterii a autorului.";
autorVarstaField.appendChild(avarstaLabel);

var addBtn = document.createElement('div');
addBtn.id = "addBtn-book";
addBtn.className = 'form-floating';
divBook.appendChild(addBtn);

var publishBookButton = document.createElement('button');
publishBookButton.className = 'btn btn-success';
publishBookButton.innerHTML = "Publica cartea";
publishBookButton.onclick = function () {publishBook();}
addBtn.appendChild(publishBookButton);

// fielduri autor

var divAutor = document.createElement('div');
divAutor.id = 'divAutor';
// container.appendChild(divAutor);

var autorNameField = document.createElement('div');
autorNameField.id = "autorNameField";
autorNameField.className = 'form-floating';
divAutor.appendChild(autorNameField);

var anameInputAutor = document.createElement('textarea');
anameInputAutor.className = "form-control";
anameInputAutor.placeholder = "Scrie numele autorului.";
anameInputAutor.id = "floatingTextarea";
autorNameField.appendChild(anameInputAutor);

var anameLabel = document.createElement('label');
anameLabel.setAttribute("for", "floatingTextarea");
anameLabel.innerHTML = "Scrie numele autorului.";
autorNameField.appendChild(anameLabel);

var autorVarstaField = document.createElement('div');
autorVarstaField.id = "autorVarstaField";
autorVarstaField.className = 'form-floating';
divAutor.appendChild(autorVarstaField)

var avarstaInputAutor = document.createElement('textarea');
avarstaInputAutor.className = "form-control";
avarstaInputAutor.placeholder = "Scrie data nasterii a autorului.";
avarstaInputAutor.id = "floatingTextarea";
autorVarstaField.appendChild(avarstaInputAutor);

var avarstaLabel = document.createElement('label');
avarstaLabel.setAttribute('for', 'floatingTextarea');
avarstaLabel.innerHTML = "Scrie data nasterii a autorului.";
autorVarstaField.appendChild(avarstaLabel);

var addAutor = document.createElement('div')
addAutor.id = "addAutor-book";
addAutor.className = 'form-floating';
divAutor.appendChild(addAutor);

var publishAutorButton = document.createElement('button');
publishAutorButton.className = 'btn btn-success';
publishAutorButton.innerHTML = "Publica autorul";
publishAutorButton.onclick = function () {publishAutor();}
addAutor.appendChild(publishAutorButton);

// fielduri librarie

var divLibrary = document.createElement('div');
divLibrary.id = "divLibrary";
// pagina.appendChild(divLibrary);


// Functii book

function changeFields() {
    if (document.getElementById('addBtn-book')) {
        divBook.removeChild(document.getElementById('addBtn-book'));
    }

    if (document.getElementById('autorNameField')) {
        divBook.removeChild(document.getElementById('autorNameField'));
    }

    if (document.getElementById('autorVarstaField')) {
        divBook.removeChild(document.getElementById('autorVarstaField'));
    }

    if (!document.getElementById('divSelector-book')) {
        divBook.appendChild(divSelector);
    }

    if (!document.getElementById('addBtn-book')) {
        divBook.appendChild(addBtn);
    }
}

function showBookFields() {
    if (!document.getElementById('divBook')) {
        pagina.appendChild(divBook);

        if (document.getElementById('divAutor')) {
            pagina.removeChild(divAutor);
        }

        if (document.getElementById('divLibrary')) {
            pagina.removeChild(divLibrary);
        }
        
        if (aLibrary.length == 0) {
            if (document.getElementById('divSelector-book')) {
                divBook.removeChild(document.getElementById('divSelector-book'));
            }
        }else if (aLibrary.length > 0) {

            if (document.getElementById('autorNameField')) {
                divBook.removeChild(document.getElementById('autorNameField'))
            }

            if (document.getElementById('autorVarstaField')) {
                divBook.removeChild(document.getElementById('autorVarstaField'))
            }

            if (!document.getElementById('divSelector-book')) {
                divBook.removeChild(document.getElementById('addBtn-book'))
                divBook.appendChild(divSelector);
                divBook.appendChild(addBtn);
            }
        }
    }
    if (aLibrary.length > 0) {
        var option;
        document.getElementById('afield-selector').value = option;
    }
}

function showNoAutorExist() {
    if (document.getElementById('afield-selector').value == "noexautor") {
        if (document.getElementById('divSelector-book')) {
            divBook.removeChild(document.getElementById('divSelector-book'));
        }
        
        if (document.getElementById('addBtn-book')) {
            divBook.removeChild(document.getElementById('addBtn-book'));
        }
    
        if (!document.getElementById('autorNameField')) {
            divBook.appendChild(autorNameField);
        }
        if (!document.getElementById('autorVarstaField')) {
            divBook.appendChild(autorVarstaField);
        }
    
        if (!document.getElementById('addBtn-book')) {
            divBook.appendChild(addBtn);
        }   
    }
}


// functii autor

function showAutorFields() {
    if (!document.getElementById('divAutor')) {
        pagina.appendChild(divAutor);

        
        if (document.getElementById('divBook')) {
            pagina.removeChild(divBook);
        }
        if (document.getElementById('divLibrary')) {
            pagina.removeChild(divLibrary);
        }

        if (!document.getElementById('autorNameField')) {
            divAutor.appendChild(autorNameField);
        }
        if (!document.getElementById('autorVarstaField')) {
            divAutor.removeChild(document.getElementById('addAutor-book'));
            divAutor.appendChild(autorVarstaField);
            divAutor.appendChild(addAutor);
        }
    }
}

// functii librarie

function showLibrary() {
    if (!document.getElementById('divLibrary')) {
        pagina.appendChild(divLibrary);
        if (document.getElementById('divBook')) {
            pagina.removeChild(divBook);
        }
        if (document.getElementById('divAutor')) {
            pagina.removeChild(divAutor);
        }

        
        var tabel = `<table class="table table-sm"><thead><tr><th scope="col">#</th><th scope="col">Numele cartii</th><th scope="col">Editura cartii</th><th scope="col">Numele Autorului</th><th scope="col">Data nasterii autor</th><th scope="col">Data Publicarii</th></tr></thead><tbody>`;

        var idLibrary = 0;

        for (let i = 0; i < abLibrary.length; i++) {
            const bName = abLibrary[i].objBook.bName;
            const bEditura = abLibrary[i].objBook.bEditura;
            const bData = abLibrary[i].objBook.bData;
            const aName = abLibrary[i].objAutor.aName;
            const aVarsta = abLibrary[i].objAutor.aVarsta;

            // console.log(++listNumber + " " + bName + " " + bEditura + " " + bData + " " + aName + " " + aVarsta);
            tabel += `<tr><td>${++idLibrary}</td><td>${bName}</td><td>${bEditura}</td><td>${aName}</td><td>${aVarsta}</td><td>${bData}</td></tr>`;
        }
    
        tabel += `</tbody></table>`;
    
        divLibrary.innerHTML = tabel;
    }
}

// functii butoane publicare

function publishBook() {
    if (aLibrary.length == 0) {
        var divAlert = document.createElement('div');
        divAlert.className = "alert alert-danger";
        divAlert.style.marginTop = "10px";
    
        if (bnameInput.value == "" && bedituraInput.value == "" && anameInput.value == "" && avarstaInput.value == "" && bdataInput.value) {
            divAlert.innerHTML = "Nu ai introdus nimic in capuri!";
            divBook.appendChild(divAlert);
        }else if (bnameInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus numele cartii!";
            divBook.appendChild(divAlert);
        }else if (bedituraInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus editura cartii!";
            divBook.appendChild(divAlert);
        }else if (bdataInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus data publicarii cartii!";
            divBook.appendChild(divAlert); 
        }else if (anameInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus numele autorului!";
            divBook.appendChild(divAlert); 
        }else if (avarstaInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus varsta autorului!";
            divBook.appendChild(divAlert); 
        }else{
    
            changeFields();

            var objBook = {'bName' : bnameInput.value, 'bEditura' : bedituraInput.value, 'bData' : bdataInput.value};
            bLibrary.push(objBook);
            localStorage.setItem('bLibrary', JSON.stringify(bLibrary))
    
            var objAutor = {'id' : ++idAutor, 'aName' : anameInput.value, 'aVarsta' : avarstaInput.value};
            aLibrary.push(objAutor);
            localStorage.setItem('aLibrary', JSON.stringify(aLibrary))
    
            for (const [key, value] of Object.entries(aLibrary)) {
                var showAutori = document.createElement('option');
                showAutori.value = value.id + ". " + value.aName;
                showAutori.text = value.id + ". " + value.aName;
                aSelector.appendChild(showAutori);
            }
    
            var objLibrary = {objBook, objAutor};
            abLibrary.push(objLibrary);
            localStorage.setItem('abLibrary', JSON.stringify(abLibrary));            
        }
    }else if (aLibrary.length > 0) {
        var divAlert = document.createElement('div');
        divAlert.id = "divAlert";
        divAlert.className = "alert alert-danger";
        divAlert.style.marginTop = "10px";
        
        if (bnameInput.value == "" && bedituraInput.value == "" && anameInput.value == "" && avarstaInput.value == "" && bdataInput.value) {
            divAlert.innerHTML = "Nu ai introdus nimic in capuri!";
            divBook.appendChild(divAlert);
        }else if (bnameInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus numele cartii!";
            divBook.appendChild(divAlert);
        }else if (bedituraInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus editura cartii!";
            divBook.appendChild(divAlert);
        }else if (bdataInput.value == "") {
            divAlert.innerHTML = "Nu ai introdus data publicarii cartii!";
            divBook.appendChild(divAlert);
        }else{

            var objBook = {'bName' : bnameInput.value, 'bEditura' : bedituraInput.value, 'bData' : bdataInput.value};
            bLibrary.push(objBook);
            localStorage.setItem('bLibrary', JSON.stringify(bLibrary))

            if (document.getElementById('divSelector-book')) {
                var selector = document.getElementById('afield-selector').value

                for (key in aLibrary) {
                    const element = selector[key];  
                    for (var i = 0, len = aLibrary.length; i < len; i++) {
                        if (element == aLibrary[i].id) {
                            var objAutor = {'aName' : aLibrary[i].aName, 'aVarsta' : aLibrary[i].aVarsta};
                            var objLibrary = {objBook, objAutor};
                            
                            abLibrary.push(objLibrary);
                            localStorage.setItem('abLibrary', JSON.stringify(abLibrary));
                            changeFields()   
                        }
                    }
                }
            }else if (!document.getElementById('divSelector-book')) {
                var objAutor = {'id' : ++idAutor, 'aName' : anameInputAutor.value, 'aVarsta' : avarstaInputAutor.value};
                aLibrary.push(objAutor);
                localStorage.setItem('aLibrary', JSON.stringify(aLibrary))

                for (const [key, value] of Object.entries(aLibrary)) {
                    var showAutori = document.createElement('option');
                    showAutori.value = value.id + ". " + value.aName;
                    showAutori.text = value.id + ". " + value.aName;
                    aSelector.appendChild(showAutori);
                }

                var objLibrary = {objBook, objAutor};
                abLibrary.push(objLibrary);
                localStorage.setItem('abLibrary', JSON.stringify(abLibrary));
                changeFields()
            } 
        }
    }
    if (aLibrary.length > 0) {
        var option;
        document.getElementById('afield-selector').value = option;
    }
}

function publishAutor() {
    var divAlert = document.createElement('div');
    divAlert.className = "alert alert-danger";
    divAlert.style.marginTop = "10px";

    if (anameInputAutor.value == "" && avarstaInputAutor.value == "") {
        divAlert.innerHTML = "Nu ai completat toate campurile!";
        divAutor.appendChild(divAlert); 
    }else if (anameInputAutor.value == "") {
        divAlert.innerHTML = "Nu ai introdus numele autorului!";
        divAutor.appendChild(divAlert); 
    }else if (avarstaInputAutor.value == "") {
        divAlert.innerHTML = "Nu ai introdus varsta autorului!";
        divAutor.appendChild(divAlert); 
    }else{
        var objAutor = {'id' : ++idAutor, 'aName' : anameInputAutor.value, 'aVarsta' : avarstaInputAutor.value};
        aLibrary.push(objAutor);
        localStorage.setItem('aLibrary', JSON.stringify(aLibrary))

        for (let [key, value] of Object. entries(aLibrary)) {
            var valoriAutori = value.id + ". " + value.aName;
        }

        var showAutori = document.createElement('option');
        showAutori.value = valoriAutori;
        showAutori.text = valoriAutori;
        aSelector.appendChild(showAutori);
        
    }
}