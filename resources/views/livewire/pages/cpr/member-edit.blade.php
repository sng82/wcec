<div class="flex h-full w-full overflow-hidden">

    <livewire:cpr.sidebar/>

    <div class="right w-full flex grow flex-col p-6 gap-8 overflow-y-auto">

        <div class="rounded-lg bg-white border border-slate-50 p-4">
            <h2 class="text-2xl text-sky-800 border-b-4 border-red-600 pb-2">
                {{ $first_name . ' ' . $last_name }}
            </h2>

            <form wire:submit="update">
                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="first_name" :value="__('First Name')" class="lg:w-48" />
                    <x-text-input wire:model="first_name" id="first_name" class="block w-full lg:w-96" type="text" name="first_name" required autofocus autocomplete="first_name" />
                </div>
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="last_name" :value="__('Last Name')" class="w-48" />
                    <x-text-input wire:model="last_name" id="last_name" class="block w-full lg:w-96" type="text" name="last_name" required autofocus autocomplete="last_name" />
                </div>
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="email" :value="__('Email')" class="w-48" />
                    <x-text-input wire:model="email" id="email" class="block w-full w-full lg:w-[500px]" type="email" name="email" required autofocus autocomplete="email" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                <div class="flex flex-col lg:flex-row lg:items-center mt-3 gap-1">
                    <x-admin-input-label for="role" :value="__('Membership Level')" class="w-48" />
                    <select wire:model="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach($roles as $r)
                            <option wire:key="{{ $r->id }}" value="{{ $r->id }}" @if($role === $r->id) selected @endif >{{ Str::of($r->name)->title() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col lg:flex-row lg:items-center mt-6 gap-1">
                    <span class="w-48"></span>
                    <div>
                        <x-primary-button>
                            {{ __('Save Changes') }}
                        </x-primary-button>
{{--                        <x-primary-button wire:click="update({{ $member->id }})">--}}
{{--                            {{ __('Save Changes') }}--}}
{{--                        </x-primary-button>--}}
                    </div>
                </div>

            </form>

            <div class="rounded-lg bg-slate-100 border border-slate-200 p-4 mt-8">
                <h3 class="text-xl text-sky-800 pb-2">Membership Details</h3>


                <table class="table-auto bg-slate-50">
                    <tbody>
                        {{-- Member --}}
                        @if($role === 5)
                            <tr class="border-b border-slate-100">
                                <td class="p-3">
                                    Member since:
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($became_member_at)->format('d/m/Y') }}
                                    ({{ \Carbon\Carbon::parse($became_member_at)->longAbsoluteDiffForHumans(now()) }})
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3">
                                    Membership Expires:
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($membership_expires_at)->format('d/m/Y') }}
                                    ({{ \Carbon\Carbon::parse(now())->longAbsoluteDiffForHumans($membership_expires_at) }})
                                </td>
                            </tr>

                        @endif

                        {{-- Lapsed Member --}}
                        @if($role === 6)
                            <tr class="border-b border-slate-100">
                                <td class="p-3">
                                    Became a member:
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($became_member_at)->format('d/m/Y') }}
                                    ({{ \Carbon\Carbon::parse($became_member_at)->longAbsoluteDiffForHumans(now()) }})
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3">
                                    Membership Expired:
                                </td>
                                <td class="p-3">
                                    {{ \Carbon\Carbon::parse($membership_expires_at)->format('d/m/Y') }}
                                    ({{ \Carbon\Carbon::parse($membership_expires_at)->diffForHumans() }})
                                </td>
                            </tr>

                        @endif
                    </tbody>

                </table>




                {{-- Accepted Applicant --}}
                @if($member->role === 5)

                @endif

                {{-- Pending Applicant --}}
                @if($member->role === 5)

                @endif

                {{-- Blocked Applicant --}}
                @if($member->role === 5)

                @endif

            </div>
        </div>
    </div>
</div>
