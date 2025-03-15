<div class="flex flex-col">

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-white to-decisioner-light-orange/20 py-16 px-4">
        <div class="container mx-auto text-center max-w-3xl">
            <h1 class="text-4xl font-bold mb-4">Get in Touch</h1>
            <p class="text-decisioner-gray text-lg mb-0">
                Have questions about Decisioner? We're here to help and would love to hear from you.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="flex-grow py-12 px-4 bg-gray-50">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Contact Information -->
                <div class="lg:col-span-1 space-y-6">
                    <x-contact-item 
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-6 w-6 text-decisioner-orange"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>'
                        title="Email Us"
                        content="support@decisioner.com"
                        link="mailto:support@decisioner.com"
                    />

                    <x-contact-item 
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone h-6 w-6 text-decisioner-orange"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>'
                        title="Call Us"
                        content="(555) 123-4567"
                        link="tel:+15551234567"
                    />

                    <x-contact-item 
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-6 w-6 text-decisioner-orange"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>'
                        title="Visit Us"
                        content="123 Decision Way, San Francisco, CA 94103"
                    />

                    <x-contact-item 
                        icon='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square h-6 w-6 text-decisioner-orange"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>'
                        title="Live Chat"
                        content="Available Mon-Fri, 9am-5pm PST"
                    />
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-bold mb-6">Send us a message</h2>

                        <form wire:submit.prevent="submit" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="text-sm font-medium text-gray-700">Your Name</label>
                                    <input type="text" id="name" wire:model="name" placeholder="Enter your full name"
                                        class="mt-1 block w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange" required>
                                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" id="email" wire:model="email" placeholder="Enter your email"
                                        class="mt-1 block w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange" required>
                                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="text-sm font-medium text-gray-700">Subject</label>
                                <input type="text" id="subject" wire:model="subject" placeholder="What is your message about?"
                                    class="mt-1 block w-full rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange" required>
                                @error('subject') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="message" class="text-sm font-medium text-gray-700">Message</label>
                                <textarea id="message" wire:model="message" placeholder="Type your message here..." class="mt-1 block w-full min-h-[150px] rounded-md border-gray-200 focus:ring-decisioner-orange focus:border-decisioner-orange" required></textarea>
                                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="bg-decisioner-orange hover:bg-orange-600 text-white py-3 px-6 rounded-lg">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>