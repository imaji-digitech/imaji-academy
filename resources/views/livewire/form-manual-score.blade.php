<div id="form-create" class=" card p-4">
    <form wire:submit.prevent="addScore">
        <x-select :options="$optionStudent" :selected="$student" title="Nama murid" model="student"/>
        <x-select :options="$optionScore" :selected="$score" title="Nama penilaian" model="score"/>
        <x-select :options="$optionTheory" :selected="$theory" title="Nilai teori" model="theory"/>
        <x-select :options="$optionPractice" :selected="$practice" title="Nilai praktik" model="practice"/>
        <x-textarea model="note" title="Keterangan"/>
        <div class="form-group col-span-6 sm:col-span-5"></div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
