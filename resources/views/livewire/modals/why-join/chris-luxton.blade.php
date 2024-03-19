<x-modal>
    <x-slot name="title">
        Why did you join the WCEC? Chris Luxton: Member Case Study
    </x-slot>

    <x-slot name="content">
        <img src="{{ Vite::asset('resources/img/Chris-Luxton-2.jpg') }}"
             class="float-end mb-3 ml-3" alt="Ceris Burns"/>
        <p class="italic text-sky-700">
            Chris Luxton, long standing member of the Worshipful Company of Environmental Cleaners (WCEC), tells us about his career and the benefits of being part of this respected livery company...
        </p>

        <p class="text-sky-600 mb-1 mt-5">
            Why did you join the WCEC?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                It’s no exaggeration to say I eat, live, sleep and breathe cleaning, so joining seemed a natural progression for me.
            </p>
            <p class="mt-1">
                I first read about the WCEC in an article published in Cleaning & Maintenance back in 2001, written by the then Master, Paul Michael. After a telephone conversation, in which I outlined my commitment to the cleaning industry and my charitable work – I was chairman of the NSPCC Swansea branch for 13 years – I was invited to attend an interview. This was a success, and I was accepted as a liveryman.
            </p>
            <p class="mt-1">
                Despite not knowing anyone in the organisation, and being the very first Welsh member (which I think I still am), I was given a warm welcome, and I must have made more than 150 new friends within the livery.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            Can you give a brief overview of your career history – and tell us what brought you to the cleaning
            industry?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                I am proud to say that I have been in the cleaning industry for over 35 years. My fascination and enthusiasm for the sector started when I came across the Von Schrader range of carpet and upholstery cleaning equipment. These products impressed me greatly and it was not long before I had built up a good customer base, who soon wanted me to expand my services. That’s when I progressed into wider contract cleaning – and I haven’t looked back since!
            </p>
            <p class="mt-1">
                I am a director of professional cleaning services company, Busy Cleaning; and commercial director of Klenitise – for whom I invented and designed UV technology products to highlight bacteria in the workplace.
            </p>
            <p class="mt-1">
                I have had many high points in my career, but perhaps my most cherished accomplishment was being made an Honorary Assistant to the WCEC in June 2014.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            What are the benefits of membership, and how have these helped you personally?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                The benefits of membership are extremely valuable. What other organisation could give you the opportunity to forge relationships with the most dedicated and skilled professionals from almost every avenue in the world of commercial cleaning? Every court luncheon is like a mini cleaning exhibition – where else could you meet all that talent in one place!
            </p>
            <p class="mt-1">
                From chemical and equipment manufacturers, to the directors of contract cleaning and facilities management companies the chance to share knowledge and best practice, and to play a role in increasing professionalism within the industry, is hard to beat.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            What would you say to someone thinking about joining the WCEC – why should they do it?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                I would say, if you want to get on in the contract cleaning industry, how could you afford not to become a member of the WCEC!
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            Why is the cleaning industry a good place to work?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                I believe the cleaning industry provides people with a truly fulfilling career – not just because it allows you to enhance health and well-being through providing cleaning services, but also because you get to meet so many people along the way. Remember: ‘To clean is to preserve’ – so anyone involved in the industry should be proud that they are really making a difference.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            What are your predictions for the cleaning industry in the future?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                Even though I haven’t got a crystal ball, there is now a greater awareness of germs and bacteria in working environments, and I only see this growing. Demand for cleaning products, equipment and methods that continually improve hygiene in the workplace will therefore continue to increase.
            </p>
        </div>

    </x-slot>

    <x-slot name="buttons">
        <button class="px-4 py-2 bg-red-700 text-white rounded-full" wire:click="$dispatch('closeModal')">Close</button>
    </x-slot>
</x-modal>
