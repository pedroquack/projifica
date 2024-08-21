

<label for="image" class="col-span-2 w-full h-24 p-2 text-center bg-white rounded-lg border text-black" id="drop-area">
    <input type="file" accept="image/*" name="image" id="image" hidden>
    <div id="img-view" class="w-full h-full rounded-lg border-dashed border-2 hover:border-emerald-500 border-emerald-400 bg-emerald-50 hover:bg-emerald-100  cursor-pointer flex items-center justify-center gap-4">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12 text-emerald-400">
            <path fill-rule="evenodd" d="M10.5 3.75a6 6 0 0 0-5.98 6.496A5.25 5.25 0 0 0 6.75 20.25H18a4.5 4.5 0 0 0 2.206-8.423 3.75 3.75 0 0 0-4.133-4.303A6.001 6.001 0 0 0 10.5 3.75Zm2.03 5.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 1 0 1.06 1.06l1.72-1.72v4.94a.75.75 0 0 0 1.5 0v-4.94l1.72 1.72a.75.75 0 1 0 1.06-1.06l-3-3Z" clip-rule="evenodd" />
          </svg>

        <p id="image-txt">Adicionar Imagem</p>
    </div>
</label>
@if ($errors->has('image'))
    <span class="invalid-feedback">
        <p>{{ $errors->first('image')}}</p>
    </span>
@endif
<script>

    const drop_area = document.getElementById('drop-area');
    const input_file = document.getElementById('image');
    const img_view = document.getElementById('img-view');
    const p = document.getElementById("image-txt");
    const file_name = @json(session()->get('file_name'));

    if(file_name){
        p.textContent = file_name;
    }

    input_file.addEventListener('change', (event) =>{
        let img_link = input_file.files[0].name;
        p.textContent = img_link
    })

    drop_area.addEventListener('dragover', (event) =>{
        event.preventDefault();
    });
    drop_area.addEventListener('drop', (event) =>{
        event.preventDefault();
        input_file.files = event.dataTransfer.files;
        let img_link = input_file.files[0].name;
        p.textContent = img_link
    });

</script>
