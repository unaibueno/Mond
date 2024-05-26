<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>

<style>
    .contenedor-selector-nota {
        background-color: #f2f2f2;
        height: 92vh;
        border-radius: 30px 0 0 30px;
        display: flex;
        flex-direction: column;
    }

    .contenedor-selector-nota h2 {
        font-family: "sf-black";
        color: #272727;
    }

    .lista-notas {
        padding: 25px;
        padding-top: 0;
        flex-grow: 1;
        overflow-y: auto;
    }

    .lista-notas ul {
        list-style: none;
        padding: 0;
    }

    .lista-notas ul li {
        margin: 10px 0;
    }

    .lista-notas ul li a {
        text-decoration: none;
        padding: 10px;
        color: #333;
        display: block;
        background-color: #e2e2e2;
        border-radius: 10px;
    }

    .lista-notas ul li a:hover {
        background-color: #c2c2c2;
    }

    .contenido-notas {
        padding: 0px 30px;
        height: 92vh;
        overflow-y: auto;
    }

    .editor-container {
        margin-top: 20px;
        height: calc(100% - 20px);
        /* Adjust for margin */
    }

    .editor-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .nueva-nota-title {
        border: none;
        padding-left: 10px;
        font-size: 18px;
        transition: transform 0.7s ease;
        transform-origin: left;
        margin-right: auto;
        font-family: 'sf-bold', sans-serif;
    }

    .nueva-nota-title:focus {
        outline: none;
        color: #272727;
        font-weight: bold;
    }

    .ck-editor__editable {
        border: none !important;
        outline: none !important;
        overflow: auto;
        height: calc(100% - 30px);
        /* Adjust for toolbar and margins */
    }

    .ck-toolbar {
        border: none !important;
        background: none !important;
        padding: 0;
        margin-left: auto;
    }

    .ck-toolbar__items {
        display: flex;
        justify-content: flex-end;
    }

    .ck-toolbar button .ck-button__label {
        font-size: 0.75rem;
    }

    .ck-toolbar button .ck-icon {
        width: 16px;
        height: 16px;
    }

    .ck-rounded-corners .ck.ck-editor__top .ck-sticky-panel .ck-sticky-panel__content,
    .ck.ck-editor__top .ck-sticky-panel .ck-sticky-panel__content.ck-rounded-corners {
        border: none;
    }

    .ck.ck-editor__editable.ck-focused:not(.ck-editor__nested-editable) {
        box-shadow: none;
    }

    .header-notas {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 30px;
        margin-top: 20px;
    }

    .header-buttons {
        display: flex;
        gap: 10px;
    }

    .header-buttons button {
        background-color: transparent;
    }

    .hidden {
        display: none;
    }

    .active-note a {
        color: #fff !important;
        background-color: #333 !important;
    }
</style>

<div class="row">
    <div class="col-3 contenedor-selector-nota">
        <div class="header-notas">
            <h2>Notas</h2>
            <div class="header-buttons">
                <form id="deleteForm" method="post" action="">
                    <button type="submit" id="deleteButton" class="hidden"><i
                            class="fa-regular fa-trash-can"></i></button>
                </form>
                <button onclick="newNote()"><i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
        <div class="lista-notas">
            <ul id="noteList">
                <?php foreach ($notes as $index => $note): ?>
                    <li id="note-<?= $note['id_nota'] ?>" <?= $index === 0 ? 'data-first="true"' : '' ?>>
                        <a href="#" onclick="selectNote(<?= $note['id_nota'] ?>)"><?= $note['titulo_nota'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-9 contenido-notas">
        <div class="editor-container">
            <div class="editor-header">
                <input class="nueva-nota-title" type="text" name="title" id="noteTitle" placeholder="Título de la nota">
                <div class="ck-toolbar"></div>
            </div>
            <form id="noteForm" method="post" action="/notas/save">
                <input type="hidden" name="id" id="noteId">
                <textarea name="content" id="editor"></textarea>
            </form>
        </div>
    </div>
</div>

<script src="/assets/js/es.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    let saveTimeout;
    let titleSaved = false;
    let currentNoteId = null;
    let currentNoteContent = '';

    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionar la primera nota automáticamente al cargar la página
        var firstNoteElement = document.querySelector('#noteList li[data-first="true"] a');
        if (firstNoteElement) {
            firstNoteElement.click();
        }
    });

    ClassicEditor
        .create(document.querySelector('#editor'), {
            language: 'es',
            removePlugins: ['MediaEmbed', 'MediaEmbedToolbar']
        })
        .then(editor => {
            console.log('Editor is ready to use!', editor);
            window.editor = editor;

            const toolbarElement = editor.ui.view.toolbar.element;
            document.querySelector('.ck-toolbar').appendChild(toolbarElement);

            window.editor.model.document.on('change:data', () => {
                clearTimeout(saveTimeout);
                saveTimeout = setTimeout(autoSaveContent, 1000);
            });
        })
        .catch(error => {
            console.error('There was a problem initializing the editor.', error);
        });

    function newNote() {
        autoSaveContent();

        document.getElementById('noteId').value = '';
        document.getElementById('noteTitle').value = '';
        window.editor.setData('');
        document.getElementById('deleteButton').classList.add('hidden');
        document.getElementById('deleteForm').action = '';
        titleSaved = false;
        currentNoteId = null;
        currentNoteContent = '';

        var notes = document.querySelectorAll('#noteList li');
        notes.forEach(note => note.classList.remove('active-note'));
    }

    function selectNote(id) {
        autoSaveContent();

        fetch(`/notas/getNote/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('noteId').value = data.note.id_nota;
                    document.getElementById('noteTitle').value = data.note.titulo_nota;
                    window.editor.setData(data.note.contenido_nota);
                    document.getElementById('deleteButton').classList.remove('hidden');
                    document.getElementById('deleteForm').action = '/notas/delete/' + data.note.id_nota;
                    titleSaved = true;
                    currentNoteId = data.note.id_nota;
                    currentNoteContent = data.note.contenido_nota;

                    var notes = document.querySelectorAll('#noteList li');
                    notes.forEach(note => note.classList.remove('active-note'));

                    document.getElementById('note-' + id).classList.add('active-note');
                } else {
                    console.error('Error al cargar la nota:', data.message);
                }
            })
            .catch(error => {
                console.error('Error al cargar la nota:', error);
            });
    }

    document.getElementById('noteTitle').addEventListener('blur', saveTitle);

    function saveTitle() {
        var noteId = document.getElementById('noteId').value;
        var noteTitle = document.getElementById('noteTitle').value;

        if (noteTitle.trim() === '') {
            return;
        }

        var formData = new FormData();
        formData.append('id', noteId);
        formData.append('title', noteTitle);

        fetch('/notas/saveTitle', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(data => {
            if (data.success) {
                console.log('Título guardado automáticamente');
                titleSaved = true;
                if (noteId === '') {
                    document.getElementById('noteId').value = data.id;
                    var newNote = document.createElement('li');
                    newNote.id = 'note-' + data.id;
                    newNote.innerHTML = `<a href="#" onclick="selectNote(${data.id})">${noteTitle}</a>`;
                    document.getElementById('noteList').appendChild(newNote);
                }
            } else {
                console.error('Error al guardar el título:', data.message);
            }
        }).catch(error => {
            console.error('Error al guardar automáticamente el título:', error);
        });
    }

    function autoSaveContent() {
        var noteId = document.getElementById('noteId').value;
        var noteContent = window.editor.getData();

        if (!titleSaved || noteContent.trim() === '') {
            return;
        }

        var formData = new FormData();
        formData.append('id', noteId);
        formData.append('content', noteContent);

        fetch('/notas/saveContent', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(data => {
            if (data.success) {
                console.log('Contenido guardado automáticamente');
                currentNoteContent = noteContent;
            } else {
                console.error('Error al guardar el contenido:', data.message);
            }
        }).catch(error => {
            console.error('Error al guardar automáticamente el contenido:', error);
        });
    }
</script>

<?= $this->endSection() ?>22