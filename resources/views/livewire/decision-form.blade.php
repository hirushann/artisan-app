<div>
    <div class="py-8 px-4 mx-auto lg:py-16" x-data="{mainType: 'personal', subType: ''}">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                aria-labelledby="dropdownHelperRadioButton">
                <li>
                    <div class="flex p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center h-7">
                            <input id="helper-radio-4" name="helper-radio" type="radio" x-model="mainType"
                                wire:model="mainPurpose" value="personal"
                                class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-500 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                        <div class="ms-2">
                            <label for="helper-radio-4" class="font-medium text-lg text-gray-900 dark:text-gray-300">
                                <div>Personal</div>
                                <p id="helper-radio-text-4"
                                    class="text-xs font-normal text-gray-500 dark:text-gray-300">Some helpful
                                    instruction goes over here.</p>
                            </label>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center h-7">
                            <input id="helper-radio-5" name="helper-radio" type="radio" x-model="mainType"
                                wire:model="mainPurpose" value="business"
                                class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-500 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                        <div class="ms-2">
                            <label for="helper-radio-5" class="font-medium text-lg text-gray-900 dark:text-gray-300">
                                <div>Business / Work</div>
                                <p id="helper-radio-text-5"
                                    class="text-xs font-normal text-gray-500 dark:text-gray-300">Some helpful
                                    instruction goes over here.</p>
                            </label>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="flex p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center h-7">
                            <input id="helper-radio-6" name="helper-radio" type="radio" x-model="mainType"
                                wire:model="mainPurpose" value="family"
                                class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 focus:ring-orange-500 dark:focus:ring-orange-500 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                        <div class="ms-2">
                            <label for="helper-radio-6" class="font-medium text-lg text-gray-900 dark:text-gray-300">
                                <div>Family</div>
                                <p id="helper-radio-text-6"
                                    class="text-xs font-normal text-gray-500 dark:text-gray-300">Some helpful
                                    instruction goes over here.</p>
                            </label>
                        </div>
                    </div>
                </li>
                <li>
                    @error('mainPurpose') <span class="error">{{ $message }}</span>@enderror
                </li>
            </ul>

            <div class="col-span-3">
                <ul class="grid w-full gap-6 md:grid-cols-4">
                    <li x-show="mainType === 'personal'">
                        <input type="radio" x-model="subType" id="buy-a-car" name="subPurpose" wire:model="subPurpose"
                            value="buy-a-car" class="hidden peer" required />
                        <label for="buy-a-car"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Buy a vehicle</div>
                                <div class="w-full text-sm text-gray-400">Best for small purchases and personal use.
                                </div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'personal'">
                        <input type="radio" x-model="subType" id="buy-a-house" name="subPurpose" wire:model="subPurpose"
                            value="buy-a-house" class="hidden peer">
                        <label for="buy-a-house"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Buy a house</div>
                                <div class="w-full text-sm text-gray-400">Good for long-term personal investment.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'personal'">
                        <input type="radio" id="new-mobile" x-model="subType" name="subPurpose" wire:model="subPurpose"
                            value="new-mobile" class="hidden peer">
                        <label for="new-mobile"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">New mobile</div>
                                <div class="w-full text-sm text-gray-400">Choosing a new smartphone or device.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'personal'">
                        <input type="radio" id="new-internet-line" x-model="subType" name="subPurpose"
                            wire:model="subPurpose" value="new-internet-line" class="hidden peer">
                        <label for="new-internet-line"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">New internet line</div>
                                <div class="w-full text-sm text-gray-400">Picking the best ISP for home internet.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'personal'">
                        <input type="radio" id="new-pet" name="subPurpose" wire:model="subPurpose" x-model="subType"
                            value="new-pet" class="hidden peer">
                        <label for="new-pet"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">New pet</div>
                                <div class="w-full text-sm text-gray-400">Adopting a pet for companionship.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'personal'">
                        <input type="radio" id="new-buys" name="subPurpose" wire:model="subPurpose" x-model="subType"
                            value="new-buys" class="hidden peer">
                        <label for="new-buys"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Buy something new</div>
                                <div class="w-full text-sm text-gray-400">Selecting a gadget, appliance, or accessory.
                                </div>
                            </div>
                        </label>
                    </li>

                    {{-- Business / Work --}}
                    <li x-show="mainType === 'business'">
                        <input type="radio" id="business-start" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="business-start" class="hidden peer">
                        <label for="business-start"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Start a business</div>
                                <div class="w-full text-sm text-gray-400">Planning to launch a new business venture.
                                </div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'business'">
                        <input type="radio" id="hire-employee" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="hire-employee" class="hidden peer">
                        <label for="hire-employee"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Hire an employee</div>
                                <div class="w-full text-sm text-gray-400">Selecting the best candidate for a job.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'business'">
                        <input type="radio" id="invest-in-tools" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="invest-in-tools" class="hidden peer">
                        <label for="invest-in-tools"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Invest in tools</div>
                                <div class="w-full text-sm text-gray-400">Choosing equipment for workplace efficiency.
                                </div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'business'">
                        <input type="radio" id="office-space-upgrade" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="office-space-upgrade" class="hidden peer">
                        <label for="office-space-upgrade"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Upgrade office space</div>
                                <div class="w-full text-sm text-gray-400">Expanding or renovating office facilities.
                                </div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'business'">
                        <input type="radio" id="new-business-sw" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="new-business-sw" class="hidden peer">
                        <label for="new-business-sw"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">New business software</div>
                                <div class="w-full text-sm text-gray-400">Selecting the best software for operations.
                                </div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'business'">
                        <input type="radio" id="company-vehicle" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="company-vehicle" class="hidden peer">
                        <label for="company-vehicle"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Company vehicle</div>
                                <div class="w-full text-sm text-gray-400">Choosing a vehicle for work-related needs.
                                </div>
                            </div>
                        </label>
                    </li>

                    <li x-show="mainType === 'family'">
                        <input type="radio" id="family-vehicle" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="family-vehicle" class="hidden peer">
                        <label for="family-vehicle"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Buy a family car</div>
                                <div class="w-full text-sm text-gray-400">Picking a safe car for family trips.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'family'">
                        <input type="radio" id="plan-a-vacation" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="plan-a-vacation" class="hidden peer">
                        <label for="plan-a-vacation"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Plan a vacation</div>
                                <div class="w-full text-sm text-gray-400">Choosing a destination for family travel.
                                </div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'family'">
                        <input type="radio" id="enroll-to-school" name="subPurpose" wire:model="subPurpose"
                            x-model="subType" value="enroll-to-school" class="hidden peer">
                        <label for="enroll-to-school"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Enroll in school</div>
                                <div class="w-full text-sm text-gray-400">Deciding on the best school for kids.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'family'">
                        <input type="radio" id="home-renno" name="subPurpose" wire:model="subPurpose" x-model="subType"
                            value="home-renno" class="hidden peer">
                        <label for="home-renno"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Home renovation</div>
                                <div class="w-full text-sm text-gray-400">Upgrading or fixing parts of the home.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'family'">
                        <input type="radio" id="adopt-pet" name="subPurpose" wire:model="subPurpose" x-model="subType"
                            value="adopt-pet" class="hidden peer">
                        <label for="adopt-pet"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Adopt a pet</div>
                                <div class="w-full text-sm text-gray-400">Choosing the right pet for the family.</div>
                            </div>
                        </label>
                    </li>
                    <li x-show="mainType === 'family'">
                        <input type="radio" id="new-gadget" name="subPurpose" wire:model="subPurpose" x-model="subType"
                            value="new-gadget" class="hidden peer">
                        <label for="new-gadget"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-orange-400 dark:peer-checked:border-orange-400 peer-checked:text-orange-400 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">New family gadget</div>
                                <div class="w-full text-sm text-gray-400">Buying a device for shared use at home.</div>
                            </div>
                        </label>
                    </li>
                    <li class="col-span-2">
                        <input type="radio" id="other-decision" x-model="subType" name="subPurpose"
                            wire:model="subPurpose" value="other-decision" class="hidden peer">
                        <label for="other-decision"
                            class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-orange-400 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block w-full">
                                <div class="w-full text-lg font-semibold mb-2">Other</div>
                                <x-input right-icon="pencil" placeholder="Decision is about" />
                            </div>
                        </label>
                    </li>
                </ul>
            </div>
        </div>

        <form action="post" x-show="subType !== ''" x-data="{ items: $wire.entangle('options').live,
        addItem() {
            if (!Array.isArray(this.items)) {
                this.items = []; // Ensure items is always an array
            }
            this.items.push({ option: '', pros: '', cons: '' });
        } }">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-10 mt-10 items-center">
                <div class="relative">
                    <h2 class="text-7xl text-center font-black mb-8">Options</h2>
                    <div class="relative flex py-5 items-center">
                        <div class="flex-grow border-t border-gray-400"></div>
                        <span class="flex-shrink mx-4 text-2xl font-black text-orange-400">with</span>
                        <div class="flex-grow border-t border-gray-400"></div>
                    </div>
                    <h2 class="text-5xl text-center font-black mt-8">Pros & Cons</h2>
                </div>
                <div
                    class="md:col-span-3 flex flex-col gap-4 border dark:border-gray-600 border-gray-300 shadow rounded-3xl p-5">
                    <div>
                        <h3 class="mb-5 text-3xl mt-5 text-center text-gray-500 font-bold dark:text-gray-300">Let's get down to the available options?</h3>
                        @error('options') <span class="error">{{ $message }}</span> @enderror
                        <div>
                            <template x-for="(item, index) in items" x-bind:key="index">
                                <div class="mb-5 relative">
                                    <div class="relative flex py-5 items-center">
                                        <span class="flex-shrink mr-4 text-2xl font-black text-orange-400">Option .<span x-text="index + 1" class="text-slate-500 font-bold dark:text-white"></span></span>
                                        <div class="flex-grow border-t border-gray-400"></div>
                                        <x-mini-button x-show="items.length > 2" rounded icon="trash" x-on:click="items.splice(index, 1)" flat negative interaction="negative" />
                                    </div>

                                    <div class="input-group mb-5 flex gap-3">
                                        <input type="text" x-model="item.option"
                                            class="bg-white dark:bg-slate-700 dark:text-gray-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5"
                                            placeholder="Enter an option" x-bind:name="'options[' + index + ']'">
                                    </div>

                                    <!-- Pros and Cons Section -->
                                    <div class="flex gap-5 w-full">
                                        <div class="w-full flex flex-col gap-3">
                                            <h4 class="text-base font-medium text-gray-900 dark:text-gray-400">Pros</h4>
                                            <textarea rows="4" x-model="item.pros"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-white dark:bg-slate-700 dark:text-gray-400 rounded-lg border border-gray-300 focus:ring-orange-400 focus:border-orange-400"
                                                placeholder="Enter pros" x-bind:name="'pros[' + index + ']'"></textarea>
                                        </div>
                                        <div class="w-full flex flex-col gap-3">
                                            <h4 class="text-base font-medium text-gray-900 dark:text-gray-400">Cons</h4>
                                            <textarea rows="4" x-model="item.cons"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-white dark:bg-slate-700 dark:text-gray-400 rounded-lg border border-gray-300 focus:ring-orange-400 focus:border-orange-400"
                                                placeholder="Enter cons" x-bind:name="'cons[' + index + ']'"></textarea>
                                        </div>
                                    </div>
                                    <hr x-show="items[index] !== items[items.length - 1]" class="my-10">
                                </div>
                            </template>

                            <!-- Submit Button -->
                            <div class="flex flex-col gap-3 my-5">
                                <x-radio id="detailed-report" rounded="base" xl label="Detailed Report" wire:model="reportType" value="detailed" />
                                <x-radio id="summarized-report" rounded="base" xl label="Summarized Report" wire:model="reportType" value="summary" />
                            </div>


                            <div class="flex gap-3">
                                <x-button info label="Let AI to make the decision.." lg wire:click="saveForm" rounded="lg" class="w-full" />
                                <x-button rounded="lg" warning label="Add Option" lg x-on:click="addItem()" class="w-full"/>

                                {{-- <button type="button" class="btn btn-secondary w-full bg-orange-400 hover:bg-orange-500 hover:shadow text-white rounded-lg px-5" x-on:click="addItem()">Add Option</button> --}}
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

</div>