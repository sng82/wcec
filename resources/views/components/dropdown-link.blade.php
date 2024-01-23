{{--<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out']) }}>--}}
{{--    {{ $slot }}--}}
{{--</a>--}}

<a {{ $attributes->merge(['class' => 'mt-2 block rounded-lg bg-transparent px-4 py-2 font-semibold hover:bg-slate-100 hover:text-red-700 focus:shadow-outline focus:bg-gray-200 focus:outline-none md:mt-0 transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>



