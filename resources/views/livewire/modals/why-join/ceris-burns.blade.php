<x-modal>
    <x-slot name="title">
        Why did you join the WCEC? Ceris Burns: Member Case Study
    </x-slot>

    <x-slot name="content">
        <img src="{{ Vite::asset('resources/img/Ceris-Burns-colour-2-225x300.jpg') }}"
             class="float-end mb-3 ml-3" alt="Ceris Burns"/>
        <p class="italic text-sky-700">
            Ceris Burns, a member of the Worshipful Company of Environmental Cleaners (WCEC), tells us about her career
            and the benefits of being part of this respected livery company...
        </p>

        <p class="text-sky-600 mb-1 mt-5">
            Why did you join the WCEC?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                I joined the WCEC because… early on in my journey, a learned soul took me under his wing and said that
                if I wanted to succeed in the cleaning industry I must join the livery. Like many others I’d never even
                heard of the WCEC. I was invited to the Ladies’ Banquet back in 2002 when I thought I was way too young
                ‘to go to an evening like that’. I’d never been to a City event in such an impressive venue.
            </p>
            <p class="mt-1">
                When I launched CBI PR, I decided that I would take the advice of my esteemed colleague. I loved the
                tradition
                of the City and the fact that I was joining the heart of my industry. A true PR and marketing pro, I
                realised that membership would give me access to a whole host of industry colleagues to network with. My
                radar was on and interest heightened.
            </p>
            <p class="mt-1">
                Friend and fellow liveryman Chris Luxton enthusiastically proposed
                my membership – I joined in 2009 and immediately applied to become a liveryman. I have since supported
                several WCEC committees and have recently been admitted as Court Assistant.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            Can you give a brief overview of your career history – and tell us what brought you to the cleaning
            industry?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                I’m a linguist and international marketer by trade. After five years marketing welding and cutting
                equipment in Italy I decided it was time to come back home. The novelty of Italy had worn off – I was
                tired of designer brands, being thin and was in need of a proper mug of tea.
            </p>
            <p class="mt-1">
                I got a job doing
                international marketing in East Sussex promoting washroom hygiene systems for Kennedy. I’d never dreamed
                of working in the cleaning industry but compared with welding it seemed pretty sanitary and, well,
                exciting. I was surprised to learn that there is so much more to cleaning and hygiene than meets the eye
                and quickly became an expert in feminine hygiene!
            </p>
            <p class="mt-1">
                Five years later I launched Ceris Burns International – the PR business that I head up today. With the
                cleaning and hygiene industries at the heart of CBI we have expanded organically to a solid team of 12
                and now span cleaning, FM and resource management. Today our campaigns reach as far afield as Australia.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            What are the benefits of membership, and how have these helped you personally?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                My days in Italy metaphorically speaking mirror how the livery has helped me in my career. Like the
                Italian matriarchal family, the WCEC has provided a welcoming protective core for me to learn the ways
                of the industry and build a powerful and friendly network.
            </p>
            <p class="mt-1">
                It is enjoyable to be a member and without
                doubt it has supported, if indirectly, the tremendous growth of CBI PR.
            </p>
            <p class="mt-1">
                Maybe I’m starting to get old
                but I wouldn’t hesitate to advise a young newcomer to join. It’s really not just for the oldies
                (although quite a few wise old owls are of course members, the recent Installation banquet hosted lots
                of fresh young faces!)
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            What would you say to someone thinking about joining the WCEC – why should they do it?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                Just do it! You won’t regret it or I’ll give you your money back! If you are serious about getting on in
                this industry it’s the very best thing you will ever do.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            Why is the cleaning industry a good place to work?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>
                It’s a down to earth ‘essential’ industry that is here for the long term. It’s also a bit addictive and
                a great source of unusual stories for the pub.
            </p>
        </div>

        <p class="text-sky-600 mb-1 mt-5">
            What are your predictions for the cleaning industry in the future?
        </p>
        <div class="mt-1 pl-3 border-l-4 border-red-700 ">
            <p>The future is bright! Google it and find out more.</p>
        </div>

    </x-slot>

    <x-slot name="buttons">
        <button class="px-4 py-2 bg-red-700 text-white rounded-full" wire:click="$dispatch('closeModal')">Close</button>
    </x-slot>
</x-modal>
