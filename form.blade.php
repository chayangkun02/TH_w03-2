@extends('layouts.app')

@section('title')
    รายงานการบำเพ็ญประโยชน์ (StuA_๖๐๕)
@endsection

@section('banner')
    <h1 class="text-4xl md:text-5xl text-amber-200 font-bold">รายงานการบำเพ็ญประโยชน์</h1>
@endsection

@section('content')
<div class="text-gray-800 mali-regular">
    <!-- ส่วนหัวเอกสาร -->
    <div class="flex justify-between items-start border-b pb-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">รายงานการบำเพ็ญประโยชน์</h2>
            <p class="text-sm text-gray-500">เรื่อง ขออนุญาตรายงานผลการบำเพ็ญประโยชน์และขอความอนุเคราะห์บันทึกชั่วโมงกิจกรรม</p>
            <p class="text-sm text-gray-600 mt-1"><strong>เรียน</strong> ผู้อำนวยการกองพัฒนานักศึกษา</p>
        </div>
        <div class="text-right">
            <span class="inline-block bg-gray-100 border border-gray-300 px-3 py-1 rounded text-sm font-semibold">
                StuA_๖๐๕
            </span>
        </div>
    </div>

    {{ html()->form('POST', '/form')->acceptsFiles()->open() }}

        <!-- วันที่เขียนรายงาน -->
        <div class="mb-6 bg-gray-50 p-4 rounded border">
            <label class="block text-sm font-semibold mb-2">วันที่เขียนรายงาน</label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    {{ html()->label('วันที่', 'report_day')->class('block text-xs text-gray-600 mb-1') }}
                    {{ html()->number('report_day')->attributes(['min' => 1, 'max' => 31])->placeholder('เช่น 15')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
                </div>
                <div>
                    {{ html()->label('เดือน', 'report_month')->class('block text-xs text-gray-600 mb-1') }}
                    {{ html()->select('report_month', [
                        'มกราคม' => 'มกราคม', 'กุมภาพันธ์' => 'กุมภาพันธ์', 'มีนาคม' => 'มีนาคม',
                        'เมษายน' => 'เมษายน', 'พฤษภาคม' => 'พฤษภาคม', 'มิถุนายน' => 'มิถุนายน',
                        'กรกฎาคม' => 'กรกฎาคม', 'สิงหาคม' => 'สิงหาคม', 'กันยายน' => 'กันยายน',
                        'ตุลาคม' => 'ตุลาคม', 'พฤศจิกายน' => 'พฤศจิกายน', 'ธันวาคม' => 'ธันวาคม'
                    ])->placeholder('-- เลือกเดือน --')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
                </div>
                <div>
                    {{ html()->label('พ.ศ.', 'report_year')->class('block text-xs text-gray-600 mb-1') }}
                    {{ html()->text('report_year', date('Y') + 543)->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
                </div>
            </div>
        </div>

        <!-- สิ่งที่ส่งมาด้วย -->
        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2">สิ่งที่ส่งมาด้วย</label>
            <div class="space-y-2">
                <div class="flex items-center">
                    {{ html()->checkbox('attachments[]', false, 'photos')->id('att_photos')->class('rounded border-gray-300 text-blue-600 mr-2') }}
                    {{ html()->label('๑. ภาพถ่ายกิจกรรม', 'att_photos')->class('text-sm') }}
                </div>
                <div class="flex items-center gap-2">
                    {{ html()->checkbox('attachments[]', false, 'others')->id('att_others')->class('rounded border-gray-300 text-blue-600') }}
                    {{ html()->label('๒. หลักฐานอื่นๆ', 'att_others')->class('text-sm whitespace-nowrap') }}
                    {{ html()->text('other_attachment_detail')->placeholder('ระบุหลักฐานอื่นๆ (ถ้ามี)')->class('w-full md:w-1/2 border-gray-300 rounded-md shadow-sm p-1.5 text-sm border') }}
                </div>
            </div>
        </div>

        <!-- ส่วนที่ 1 : ข้อมูลนักศึกษาและรายละเอียดกิจกรรม -->
        <h3 class="text-lg font-semibold border-b pb-2 mb-4 text-blue-800">ส่วนที่ ๑ : ข้อมูลนักศึกษาและรายละเอียดกิจกรรม</h3>
        
        <div class="mb-4">
            {{ html()->label('ด้วย ข้าพเจ้า (นาย, นางสาว)', 'fullname')->class('block text-sm font-medium mb-1') }}
            {{ html()->text('fullname')->required()->placeholder('พิมพ์คำนำหน้า ชื่อ - นามสกุล')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                {{ html()->label('รหัสนักศึกษา', 'student_id')->class('block text-sm font-medium mb-1') }}
                {{ html()->text('student_id')->required()->placeholder('พิมพ์รหัสนักศึกษา')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
            </div>
            <div>
                {{ html()->label('โทรศัพท์มือถือ', 'phone')->class('block text-sm font-medium mb-1') }}
                {{ html()->text('phone')->required()->placeholder('พิมพ์เบอร์โทรศัพท์มือถือ')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
            </div>
            <div>
                {{ html()->label('คณะ', 'faculty')->class('block text-sm font-medium mb-1') }}
                {{ html()->select('faculty', [
                    'คณะครุศาสตร์' => 'คณะครุศาสตร์',
                    'คณะมนุษยศาสตร์และสังคมศาสตร์' => 'คณะมนุษยศาสตร์และสังคมศาสตร์',
                    'คณะวิทยาศาสตร์และเทคโนโลยี' => 'คณะวิทยาศาสตร์และเทคโนโลยี',
                    'คณะวิทยาการจัดการ' => 'คณะวิทยาการจัดการ',
                    'คณะเทคโนโลยีอุตสาหกรรม' => 'คณะเทคโนโลยีอุตสาหกรรม',
                    'คณะเทคโนโลยีการเกษตร' => 'คณะเทคโนโลยีการเกษตร',
                    'คณะนิเทศศาสตร์' => 'คณะนิเทศศาสตร์',
                    'คณะนิติศาสตร์' => 'คณะนิติศาสตร์',
                    'คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ' => 'คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ',
                    'คณะพยาบาลศาสตร์' => 'คณะพยาบาลศาสตร์',
                ])->placeholder('-- เลือกคณะ --')->required()->class('w-full border-gray-300 rounded-md shadow-sm p-2 border bg-white') }}
            </div>
            <div>
                {{ html()->label('สาขาวิชา', 'major')->class('block text-sm font-medium mb-1') }}
                {{ html()->text('major')->required()->placeholder('พิมพ์สาขาวิชา')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
            </div>
        </div>

        <div class="mb-4">
            {{ html()->label('ได้บำเพ็ญประโยชน์ ณ (สถานที่)', 'location')->class('block text-sm font-medium mb-1') }}
            {{ html()->text('location')->required()->placeholder('พิมพ์สถานที่ปฏิบัติงานบำเพ็ญประโยชน์')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                {{ html()->label('ในวันที่', 'activity_date')->class('block text-sm font-medium mb-1') }}
                {{ html()->date('activity_date')->required()->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
            </div>
            <div>
                {{ html()->label('ตั้งแต่เวลา', 'start_time')->class('block text-sm font-medium mb-1') }}
                {{ html()->time('start_time')->required()->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
            </div>
            <div>
                {{ html()->label('รวมเป็น (ชม.)', 'total_hours')->class('block text-sm font-medium mb-1') }}
                {{ html()->number('total_hours')->attributes(['step' => '0.5', 'min' => '0.5'])->required()->placeholder('พิมพ์จำนวนชั่วโมง')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">ซึ่งมีลักษณะกิจกรรม/งานที่ได้รับมอบหมายให้ปฏิบัติ</label>
            <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm">(๑)</span>
                    {{ html()->text('task_1')->required()->placeholder('พิมพ์ลักษณะงานข้อที่ 1')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm">(๒)</span>
                    {{ html()->text('task_2')->placeholder('พิมพ์ลักษณะงานข้อที่ 2 (ถ้ามี)')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-sm">(๓)</span>
                    {{ html()->text('task_3')->placeholder('พิมพ์ลักษณะงานข้อที่ 3 (ถ้ามี)')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border') }}
                </div>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">ทั้งนี้ ข้าพเจ้าได้แนบหลักฐานเป็นภาพถ่าย ดังภาพ</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    {{ html()->label('ภาพที่ ๑', 'photo_1')->class('block text-sm font-semibold mb-3') }}
                    {{ html()->file('photo_1')->acceptImage()->class('w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100') }}
                </div>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    {{ html()->label('ภาพที่ ๒', 'photo_2')->class('block text-sm font-semibold mb-3') }}
                    {{ html()->file('photo_2')->acceptImage()->class('w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100') }}
                </div>
            </div>
        </div>

        <!-- การรับรองและลงชื่อ -->
        <div class="mb-8 bg-blue-50 p-4 rounded border border-blue-100">
            <p class="text-sm text-center mb-4 font-medium">
                "ข้าพเจ้าขอรับรองว่า การบำเพ็ญประโยชน์ของนักศึกษา ได้ดำเนินกิจกรรมดังกล่าวจริง"
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-gray-700">ลงชื่อนักศึกษา</p>
                    {{ html()->text('student_signature')->placeholder('พิมพ์ชื่อ-สกุล เพื่อลงนาม')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border bg-white') }}
                </div>
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-gray-700">ผู้ควบคุม/ผู้รับรอง</p>
                    {{ html()->text('supervisor_name')->placeholder('ชื่อ-สกุล ผู้ควบคุม/ผู้รับรอง')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border bg-white') }}
                    {{ html()->text('supervisor_position')->placeholder('ตำแหน่ง')->class('w-full border-gray-300 rounded-md shadow-sm p-2 border bg-white') }}
                </div>
            </div>
        </div>

        <!-- ส่วนของเจ้าหน้าที่กองพัฒนานักศึกษา -->
        <div class="border-t-2 border-gray-400 pt-6 mt-6 bg-gray-50 p-6 rounded-lg">
            <h3 class="text-md font-bold text-gray-800 mb-4 uppercase tracking-wide">
                ส่วนนี้สำหรับเจ้าหน้าที่กองพัฒนานักศึกษา เท่านั้น
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded border space-y-3">
                    <h4 class="font-semibold text-sm border-b pb-1">๑. ผู้รับผิดชอบงานกิจกรรมนักศึกษา</h4>
                    <div>
                        {{ html()->label('ความเห็น', 'staff_comment')->class('block text-xs text-gray-600 mb-1') }}
                        {{ html()->textarea('staff_comment')->rows(2)->class('w-full border-gray-300 rounded-md shadow-sm p-2 border text-sm') }}
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        {{ html()->text('staff_name')->placeholder('ลงชื่อเจ้าหน้าที่')->class('border-gray-300 rounded p-1.5 border text-sm') }}
                        {{ html()->date('staff_date')->class('border-gray-300 rounded p-1.5 border text-sm') }}
                    </div>

                    <div class="pt-2 border-t">
                        <label class="block text-xs font-semibold mb-1">การปฏิบัติงาน</label>
                        <div class="space-y-1 text-sm">
                            <div class="flex items-center">
                                {{ html()->radio('record_status', false, 'recorded')->id('status_recorded')->class('mr-2') }}
                                {{ html()->label('บันทึกเข้าระบบแล้ว', 'status_recorded') }}
                            </div>
                            <div class="flex items-center">
                                {{ html()->radio('record_status', false, 'failed')->id('status_failed')->class('mr-2') }}
                                {{ html()->label('ไม่สามารถบันทึกข้อมูลเข้าระบบได้', 'status_failed') }}
                            </div>
                            {{ html()->text('record_fail_reason')->placeholder('เนื่องจาก...')->class('w-full border-gray-300 rounded p-1.5 border text-xs mt-1') }}
                        </div>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            {{ html()->text('recorder_name')->placeholder('ลงชื่อผู้บันทึก')->class('border-gray-300 rounded p-1.5 border text-sm') }}
                            {{ html()->date('recorder_date')->class('border-gray-300 rounded p-1.5 border text-sm') }}
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded border space-y-3">
                    <h4 class="font-semibold text-sm border-b pb-1">๒. ผู้อำนวยการกองพัฒนานักศึกษา</h4>
                    <div>
                        {{ html()->label('ความเห็น', 'director_comment')->class('block text-xs text-gray-600 mb-1') }}
                        {{ html()->textarea('director_comment')->rows(2)->class('w-full border-gray-300 rounded-md shadow-sm p-2 border text-sm') }}
                    </div>
                    <div class="space-y-1 text-sm">
                        <div class="flex items-center">
                            {{ html()->radio('approval_status', false, 'approved')->id('dir_approved')->class('mr-2') }}
                            {{ html()->label('อนุญาต', 'dir_approved') }}
                        </div>
                        <div class="flex items-center">
                            {{ html()->radio('approval_status', false, 'rejected')->id('dir_rejected')->class('mr-2') }}
                            {{ html()->label('ไม่อนุญาต', 'dir_rejected') }}
                        </div>
                        {{ html()->text('rejection_reason')->placeholder('เนื่องจาก...')->class('w-full border-gray-300 rounded p-1.5 border text-xs mt-1') }}
                    </div>
                    <div class="space-y-2 pt-2">
                        {{ html()->text('director_name')->placeholder('ลงชื่อผู้อำนวยการฯ')->class('w-full border-gray-300 rounded p-1.5 border text-sm') }}
                        {{ html()->text('director_position')->placeholder('ตำแหน่ง')->class('w-full border-gray-300 rounded p-1.5 border text-sm') }}
                        {{ html()->date('director_date')->class('w-full border-gray-300 rounded p-1.5 border text-sm') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-3">
            {{ html()->reset('ล้างข้อมูล')->class('px-5 py-2.5 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-medium cursor-pointer') }}
            {{ html()->submit('บันทึกแบบฟอร์มรายงาน')->class('px-6 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-medium shadow cursor-pointer') }}
        </div>

    {{ html()->form()->close() }}
</div>
@endsection