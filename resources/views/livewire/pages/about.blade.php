<main>
    <div class="mx-auto w-full image-banner banner-about border-b border-gray-200 aspect-[3/2] max-w-[1920px] md:aspect-[2/1] lg:aspect-[3/1]"></div>

    <div class="w-full py-12 lg:py-20" >
        <div class="container mx-auto px-5">
            <div class="flex flex-col gap-8 xl:flex-row 2xl:gap-12">
                <div class="bg-white text-sky-950">
                    <h1 class="mb-2 lg:mb-4 text-3xl font-brand md:text-4xl lg:text-5xl text-red-700">
                        About Us
                    </h1>
                    <hr class="mb-2 lg:mb-4">
                    <p>
                        We are one of 111 <a class="text-red-700 hover:text-red-500" href="https://www.cityoflondon.gov.uk/about-us/law-historic-governance/livery-companies">Livery companies in the City of London</a>
                        and follow many City traditions,
                        including supporting the Lord Mayor, Aldermen and Commonalty.
                    </p>
                    <p>
                        We are a membership organisation for those who work in (or used to work in) environmental cleaning or associated businesses. This includes:
                    </p>
                    <ul class="my-6 ml-4 list-disc marker:text-red-700 space-y-4 md:columns-2">
                        <li>Contract Cleaners</li>
                        <li>Facilities Management</li>
                        <li>Chemical Manufacturers</li>
                        <li>Paper Manufacturers</li>
                        <li>Janitorial Suppliers</li>
                        <li>Environmental Health officers</li>
                        <li>Waste Management Industry</li>
                        <li>Cleaning Equipment Manufacturing</li>
                    </ul>

                    <p>
                        The Environmental Cleaners is a good example of a modern livery company. The ceremony and pageantry is important, but our key objectives of maintaining high standards of practice within the environmental cleaning industries and raising money for our many charities is a greater part of what we do.
                    </p>

                    <img src="{{ Vite::asset('resources/img/wc-ec-pic.jpeg') }}" class="mx-auto mt-12 max-h-96 rounded-lg" alt="random pic">
                </div>

                <!-- Sidebar -->
                <div class="flex flex-col gap-y-8 xl:max-w-md xl:min-w-96">

                    <div class="rounded-2xl bg-red-700 px-9 py-8 text-white">
                        <h2 class="mb-3 text-3xl">Livery Membership</h2>
                        <hr class="mb-3">
                        <p class="text-red-100">
                            Find out more about the companies membership, and our members.
                        </p>
                        <a href="/membership" class="mt-4 inline-block rounded-full border-2 border-white px-8 py-2 font-bold uppercase transition-all duration-300 hover:bg-white hover:text-red-700">
                            Membership
                        </a>
                    </div>

                    <div class="rounded-2xl bg-sky-800 px-9 py-8 text-white">
                        <h2 class="mb-3 text-3xl">Charitable Trust</h2>
                        <hr class="mb-3">
                        <p class="text-sky-100">
                            Find out about our charitable trust.
                        </p>
                        <a href="/charitable-trust" class="mt-4 inline-block rounded-full border-2 border-white px-8 py-2 font-bold uppercase transition-all duration-300 hover:bg-white hover:text-sky-900">
                            Charitable Trust
                        </a>
                    </div>

                    <div class="rounded-2xl bg-orange-600 px-9 py-8 text-white">
                        <h2 class="mb-3 text-3xl">Chartered Practitioners</h2>
                        <hr class="mb-3">
                        <p class="text-orange-100">
                            Find out about, and join our register for Environmental Cleaning Professionals.
                        </p>
                        <a href="/chartered-practitioners" class="mt-4 inline-block rounded-full border-2 border-white px-8 py-2 font-bold uppercase transition-all duration-300 hover:bg-white hover:text-orange-600">
                            Chartered Practitioners
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
