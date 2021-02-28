<div class="h-auto" id="section_image" style=" width: 100%;text-align: center;overflow: hidden;">
    <label for="work" class="block uppercase tracking-wide text-xs font-bold mb-2"> Kehadiran</label>
    <select class="rounded w-full block" name="type" onchange="typePresensi(this)">
        <option value="hadir">Hadir</option>
        <option value="sakit">Sakit</option>
        <option value="ijin">Ijin</option>
        <option value="sppd">SPPD</option>
    </select>
</div>

<div class=" h-auto gap-4 hidden" id="start_end_date"> 
    <div class="flex-grow w-1/2">
        <label for="work" class="block uppercase tracking-wide text-xs font-bold mb-2"> Start Date</label>
        <input type="date" name="" id="" class="rounded w-full block">
    </div>
    <div class="flex-grow w-1/2">
        <label for="status" class="block uppercase tracking-wide text-xs font-bold mb-2"> End Date</label>
        <input type="date" name="" id="" class="rounded w-full block">

    </div>
</div>
<div class="flex h-auto gap-4">
    <div class="flex-grow w-1/2">
        <label for="work" class="block uppercase tracking-wide text-xs font-bold mb-2"> Work</label>
        <select class="rounded w-full block" name="work" >
            <option value="wfh">WFH</option>
            <option value="wfo">WFO</option>
            <option value="satelit">Satelit</option>
        </select>
    </div>
    <div class="flex-grow w-1/2">
        <label for="status" class="block uppercase tracking-wide text-xs font-bold mb-2"> Status</label>
        <select id="status" name="status" class="rounded w-full" onchange="onChangeStatus(this)">
            <option value="sehat">Sehat</option>
            <option value="kurang sehat">Kurang Sehat</option>
            <option value="sakit">Sakit</option>
        </select>
    </div>
</div>
<div class="h-auto hidden" id="card_check">
    <label for="detail" class="block uppercase tracking-wide text-xs font-bold mb-2"> Alasan Telat</label>
    <textarea class="w-full rounded h-full" name="detail_check" id="detail_check"></textarea>
</div>

<div class="h-auto hidden" id="card_status">
    <label for="detail" class="block uppercase tracking-wide text-xs font-bold mb-2"> Alasan</label>
    <textarea class="w-full h-full" name="detail_status" id="detail_status"></textarea>
</div>