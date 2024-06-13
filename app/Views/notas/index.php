<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="assets/css/notas.css">
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
                <?php foreach (array_reverse($notes) as $note): ?>
                    <li id="note-<?= $note['id_nota'] ?>">
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
        var firstNoteElement = document.querySelector('#noteList li:first-child a');
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
                    var firstNoteElement = document.querySelector('#noteList li:first-child');
                    document.getElementById('noteList').insertBefore(newNote, firstNoteElement);
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
<?= $this->endSection() ?>