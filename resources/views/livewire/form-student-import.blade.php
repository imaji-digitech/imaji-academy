<div id="form-create" class=" card p-4">
    <form action="{{ route('admin.imaji-academy.import',$imajiAcademyId) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-span-6 sm:col-span-5">
            <label for="">File excel upload</label>
            <input type="file" class="form form-control" name="file">
        </div>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
