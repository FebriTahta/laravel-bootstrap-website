<form action="{{ route('import.backup') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file" accept=".xlsx, .xls">
    <button type="submit">Import Excel</button>
</form>