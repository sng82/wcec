<main>
    <div class="w-full py-12 lg:py-20" >
        <div class="container mx-auto px-5">
            <div class="flex flex-col">
                <h1 class="mb-2 lg:mb-4 text-3xl font-brand md:text-4xl lg:text-5xl text-red-700">
                    Chartered Practitioners
                </h1>
                <hr class="mb-2 lg:mb-4">
                <p class="mb-12">
                    The Worshipful Company of Environmental Cleaners (WCEC) have developed a register for Environmental Cleaning Professionals as a means of recognising and maintaining high standards and ongoing proficiency for individuals.
                </p>
                @if(config('cpp.active'))
                    <livewire:component.public-registrants></livewire:component.public-registrants>
                @endif
            </div>

        </div>
    </div>
    <div class="w-full py-12 lg:py-20 bg-slate-100" >
        <div class="container mx-auto px-5">

            <div class="flex flex-col gap-8 xl:flex-row xl:items-center 2xl:gap-16 mb-12">
                <div class="text-sky-950">
                    <h2 class="mb-2 lg:mb-4 text-2xl font-brand md:text-3xl lg:text-4xl text-red-700">
                        Joining the Register
                    </h2>
                    <hr class="mb-2 lg:mb-4 border-slate-300">
                    <h3 class="mt-8 mb-4 text-2xl xl:text-3xl ">
                        Applicants
                    </h3>
{{--                    <hr class="mb-2">--}}
                    <p>
                        Those applying must be of integrity and have a good level of general expertise, operating at a strategic or senior level, as defined in the application document. Admittance to the Register demonstrates to clients, employers, peers and the public an ability to perform at a high standard, and a commitment to continuing professional development.
                    </p>
                    <h3 class="mt-8 mb-4 text-2xl xl:text-3xl ">
                        Requirements
                    </h3>
{{--                    <hr class="mb-2">--}}
                    <p>
                        Registrants will be required to demonstrate good inclusive knowledge and understanding, also proving they have reached a minimum competence level in six defined areas of expertise, which when collated will also prove they have achieved at least 80% of the required overall competency levels.
                    </p>
                    <p>
                        Click Apply (<span class="inline xl:hidden">below</span><span class="hidden xl:inline">to the right</span>) to start the process of joining the practitioners register.
                    </p>
                    <p>
                        Further details can be downloaded in the sections below or contact the Clerk at <a href="mailto:clerk@wc-ec.com" class="text-red-700 hover:text-red-800">clerk@wc-ec.com</a> for further information.
                    </p>
                </div>

                <!-- Sidebar -->
                <div class="flex flex-col gap-y-8 xl:max-w-md xl:min-w-96 ">

                    <div class="rounded-2xl bg-sky-800 px-9 py-8 text-white shadow-md shadow-slate-300">
                        <h2 class="mb-3 text-2xl">Expression of Interest</h2>
                        <hr class="mb-3">
                        <p class="text-sky-100">
                            Click here to get started joining the Chartered Practitioners Register.
                        </p>

                        <a href="/register" class="mt-4 inline-block rounded-full border-2 border-white px-8 py-2 font-bold uppercase transition-all duration-300 hover:bg-white hover:text-sky-900">
                            Apply
                        </a>
                    </div>

                    <div class="rounded-2xl bg-red-700 px-9 py-8 text-white shadow-md shadow-slate-300">
                        <h2 class="mb-3 text-2xl">Chartered Practitioner Login</h2>
                        <hr class="mb-3">
                        <p class="text-red-100">
                            Existing registrants of the Chartered Practitioners Register, and those who have already started the application process can log in here.
                        </p>
                        <a href="/login" class="mt-4 inline-block rounded-full border-2 border-white px-8 py-2 font-bold uppercase transition-all duration-300 hover:bg-white hover:text-red-700">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full py-12 lg:py-20 bg-slate-200">
        <div class="text-sky-950 px-5">
            <div class="container mx-auto px-5">
                <div class="flex w-full 2xl:w-2/3 justify-center items-center mx-auto h-auto mb-8">
                    <!--actual component start-->
                    <div x-data="tabSwitch()">
                        <ul class="flex justify-center items-center my-4">
                            <template x-for="(tab, index) in tabs" :key="index">
                                <li class="cursor-pointer py-2 px-6 text-gray-500 border-b-8"
                                    :class="activeTab===index ? 'text-red-700 border-red-700' : 'border-slate-300'" @click="activeTab = index"
                                    x-text="tab"></li>
                            </template>
                        </ul>

                        <div class="w-full bg-white mx-auto rounded-lg shadow-md shadow-slate-400">
                            <div x-show="activeTab===0">
                                <div class="px-16 py-8">
                                    <h2 class="mt-8 mb-2 text-2xl xl:text-3xl ">Guide for Expression of Interest</h2>
                                    <hr class="mb-2">
                                    <p>
                                        This guidance is written to help you focus on what to include in your application to the Register of Chartered Practitioners in Environmental Cleaning. It also describes the application process.

                                    </p>
                                    <h3 class="mt-8 mb-2 text-xl xl:text-2xl">Eligibility</h3>
                                    <hr class="mb-2">

                                    <p>
                                        An Environmental Cleaning Professional who can demonstrate the required competency levels over the prescribed timescales, who passes the background checks or who holds a professional status i.e., professional membership, may apply to be admitted to the Register of Chartered Environmental Cleaning Professionals. This includes those persons who specialise in the delivery of cleaning services, associated services, training/education in the cleaning and associated industries and the Armed Forces, and anyone employed directly in the administration of cleaning standards. These are core requirements for a Chartered Environmental Cleaning Professional.
                                    </p>
                                    <ul class="mt-4 mb-6 ml-4 list-disc marker:text-red-700 space-y-3">
                                        <li>
                                            You will need to demonstrate you adopt a strategic approach. This is not necessarily reliant on holding a directorial position, but there must be clear evidence of your personal contribution.
                                        </li>
                                        <li>
                                            Whilst you may be a subject expert in a specific area of cleaning, you will be required to demonstrate a broad knowledge of the industry.
                                        </li>
                                    </ul>

                                    <p>
                                        Once admitted, you remain on the Register by:
                                    </p>
                                    <ul class="mt-4 mb-6 ml-4 list-disc marker:text-red-700 space-y-3">
                                        <li>
                                            Compliance with a Code of Conduct,
                                        </li>
                                        <li>
                                            Participation in and confirmation that you comply with the criteria of the Environmental Cleaning Practitioner Continuous Professional Development scheme, and
                                        </li>
                                        <li>
                                            Payment of an annual fee.
                                        </li>
                                    </ul>

                                    <h3 class="mt-8 mb-2 text-xl xl:text-2xl">The Application Process</h3>
                                    <hr class="mb-2">

                                    <ul class="mt-4 mb-6 ml-4 list-disc marker:text-red-700 space-y-3">
                                        <li>
                                            The Worshipful Company of Environmental Cleaners is the Chartered Body with the Officers responsible for the Chartered Register.
                                        </li>
                                        <li>
                                            The admittance process is through a Select Committee from within the Company.
                                        </li>
                                        <li>
                                            The first step for interested individuals is to complete an Expression of Interest document.
                                        </li>
                                        <li>
                                            This application must be made on the official Expression of Interest form, along with copies of qualification certificates, supporting evidence as required at this stage, current CV and photo ID, which should be submitted to the Clerk for formal approval by the Select Committee (downloaded via the web portal)
                                        </li>
                                        <li>
                                            This should be accompanied by a registration fee of £{{ $current_registration_fee->amount }} +VAT (non-refundable). This is paid through the web portal.
                                        </li>
                                        <li>
                                            Once this is in place the process of gathering evidence for the application begins.
                                        </li>
                                    </ul>

                                    <p>
                                        On approval an application fee of £{{ $current_submission_fee->amount }} + VAT will be required. This must be paid prior to acceptance on to the register.
                                    </p>
                                    <p>
                                        There are two pathways to registration – the Standard path and the Individual path. Download full documentation below.
                                    </p>

                                </div>

                                <div class="rounded-b-lg bg-sky-800 px-16 pt-8 pb-12 text-white">
                                    <h2 class="mb-3 text-2xl xl:text-3xl">Materials</h2>
                                    <hr class="mb-3">
                                    <a href="/storage/documents/{{ $eoi_form_document->file_name }}"
                                       class="flex text-sky-100 hover:text-white align-center mt-3"
                                       download>
                                        <span class="inline-block w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </span>
                                        <span class="inline-block">
                                            {{ $eoi_form_document->doc_type }} (v{{ $eoi_form_document->version }} {{ $eoi_form_document->release_month }} {{ $eoi_form_document->release_year }})
                                        </span>
                                    </a>
                                    <a href="/storage/documents/{{ $eoi_guide_document->file_name }}"
                                       class="flex text-sky-100 hover:text-white align-center mt-3"
                                       download>
                                        <span class="inline-block w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </span>
                                        <span class="inline-block">
                                            {{ $eoi_guide_document->doc_type }} (v{{ $eoi_guide_document->version }} {{ $eoi_guide_document->release_month }} {{ $eoi_guide_document->release_year }})
                                        </span>
                                    </a>
                                </div>


                            </div>
                            <div x-show="activeTab===1">
                                <div class="px-16 py-8">
                                    <h2 class="mt-8 mb-2 text-2xl xl:text-3xl ">Assessment Guidelines</h2>
                                    <hr class="mb-2">
                                    <p>
                                        The assessment of each submission will be marked by 3 individuals appointed from the CPR / Education Committee (and approved other individuals). The same 3 individuals will be the panel for the presentation and interview as detailed in Section F. These activities will take place three or four times on predetermined dates throughout the year, and be reviewed as the demand requires.
                                    </p>
                                    <p>
                                        Feedback will be provided by the panel, Firstly at the time of the written submission and secondly after the interview.
                                    </p>
                                    <p>
                                        Any applicant not achieving the required marks will be invited to resubmit their written submission once only within one calendar month of notification.
                                    </p>
                                    <p>
                                        Any applicant not achieving the required marks following interview will be invited to one further interview only.
                                    </p>
                                    <p>
                                        Any further need for resubmission will require the candidate to reapply with the appropriate payment made.
                                    </p>

                                    <h3 class="mt-8 mb-2 text-xl xl:text-2xl">Scope of Submission</h3>
                                    <hr class="mb-2">
                                    <p>
                                        The submission will include completion of a submission (approximately 10,000 words in length, 10% will be allowed either way) demonstrating that the applicant has met the defined competence requirements from all the five key elements (A-E).
                                    </p>
                                    <p>
                                        The submission should directly reflect the experience, the knowledge and the skills of the applicant.
                                    </p>

                                    <h3 class="mt-8 mb-2 text-xl xl:text-2xl">Core Criteria</h3>
                                    <hr class="mb-2">
                                    <p>
                                        The marking criteria (competence standards) for all elements draw upon the following minimum core criteria, which are applicable to the assessment of most of or all of the assignments:
                                    </p>
                                    <ul class="mt-4 mb-6 ml-4 list-disc marker:text-red-700 space-y-3">
                                        <li>
                                            Understanding of the subject.
                                        </li>
                                        <li>
                                            Utilisation of recognised technical, professional and academic sources.
                                        </li>
                                        <li>
                                            Relevance of material selected and of the arguments proposed.
                                        </li>
                                        <li>
                                            Planning and organisation.
                                        </li>
                                        <li>
                                            Logical coherence.
                                        </li>
                                        <li>
                                            Critical evaluation.
                                        </li>
                                        <li>
                                            Comprehensiveness of research.
                                        </li>
                                        <li>
                                            Innovation / Creativity / Originality.
                                        </li>
                                    </ul>

                                    <p>
                                        The language used must be of a sufficient and suitable standard to permit assessment of the above criteria.
                                    </p>
                                    <p>
                                        These minimum core criteria form a part of professionally measurable standards and as such would not usually be subject to any modification; any submission concerning reasonable adjustments for disability should be submitted as an annex to the submission.
                                    </p>
                                    <p>
                                        Download full documentation below.
                                    </p>

                                </div>

                                <div class="rounded-b-lg bg-sky-800 px-16 pt-8 pb-12 text-white">
                                    <h2 class="mb-2 text-2xl xl:text-3xl">Materials</h2>
                                    <hr class="mb-2">
                                    <a href="/documents/{{ $assessment_criteria_document->file_name }}"
                                       class="flex text-sky-100 hover:text-white align-center mt-3"
                                       download>
                                        <span class="inline-block w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </span>
                                        <span class="inline-block">
                                            {{ $assessment_criteria_document->doc_type }} (v{{ $assessment_criteria_document->version }} {{ $assessment_criteria_document->release_month }} {{ $assessment_criteria_document->release_year }})
                                        </span>
                                    </a>

                                    <a href="/documents/{{ $appendix_document->file_name }}"
                                       class="flex text-sky-100 hover:text-white align-center mt-3"
                                       download>
                                        <span class="inline-block w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </span>
                                        <span class="inline-block">
                                            {{ $appendix_document->doc_type }} (v{{ $appendix_document->version }} {{ $appendix_document->release_month }} {{ $appendix_document->release_year }})
                                        </span>
                                    </a>

                                    <a href="/documents/{{ $definitions_document->file_name }}"
                                       class="flex text-sky-100 hover:text-white align-center mt-3"
                                       download>
                                        <span class="inline-block w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </span>
                                        <span class="inline-block">
                                            {{ $definitions_document->doc_type }} (v{{ $definitions_document->version }} {{ $definitions_document->release_month }} {{ $definitions_document->release_year }})
                                        </span>
                                    </a>

                                    <a href="/documents/{{ $appeals_document->file_name }}"
                                       class="flex text-sky-100 hover:text-white align-center mt-3"
                                       download>
                                        <span class="inline-block w-7">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </span>
                                        <span class="inline-block">
                                            {{ $appeals_document->doc_type }} (v{{ $appeals_document->version }} {{ $appeals_document->release_month }} {{ $appeals_document->release_year }})
                                        </span>
                                    </a>
                                </div>

                            </div>

                        </div>

                        {{--            <ul class="flex justify-center items-center my-4">--}}
                        {{--                <template x-for="(tab, index) in tabs" :key="index">--}}
                        {{--                    <li class="cursor-pointer py-3 px-4 rounded transition"--}}
                        {{--                        :class="activeTab===index ? 'bg-green-500 text-white' : ' text-gray-500'" @click="activeTab = index"--}}
                        {{--                        x-text="tab"></li>--}}
                        {{--                </template>--}}
                        {{--            </ul>--}}

                        {{--            <div class="flex gap-4 justify-center border-t p-4">--}}
                        {{--                <button--}}
                        {{--                    class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"--}}
                        {{--                    @click="activeTab--" x-show="activeTab>0"--}}
                        {{--                >Back</button>--}}
                        {{--                <button--}}
                        {{--                    class="py-2 px-4 border rounded-md border-blue-600 text-blue-600 cursor-pointer uppercase text-sm font-bold hover:bg-blue-500 hover:text-white hover:shadow"--}}
                        {{--                    @click="activeTab++" x-show="activeTab<tabs.length-1"--}}
                        {{--                >Next</button>--}}
                        {{--            </div>--}}
                    </div>
                    <!--actual component end-->
                </div>
            </div>
        </div>
    </div>

    <script>
        function tabSwitch() {
            return {
                activeTab: 0,
                tabs: [
                    "Expression of Interest",
                    "Award",
                ]
            };
        }
    </script>
</main>
