<div class="max-w-4xl bg-white border gap-4 md:gap-8 my-4 md:my-8 w-full mx-auto p-4">
    <div class="flex justify-between">
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="<?php echo e($invoice->patient->name); ?>"
            class="inline-block rounded-lg bg-white w-32 h-32 object-cover border">
        <div class="flex flex-col space-y-4">
            <h1 class="text-xl font-medium capitalize"><?php echo e(config('app.name')); ?></h1>
            <div class="w-[200px] text-sm ml-auto">
                <p class="flex  justify-between">
                    <span class="text-gray-500">Invoice No:</span>
                    <span><?php echo e('00'. $invoice->id); ?></span>
                </p>
                <p class="flex  justify-between">
                    <span class="text-gray-500">Invoice Date:</span>
                    <span><?php echo e($invoice->visited_at->format('d M, y')); ?></span>
                </p>
                <p class="flex  justify-between">
                    <span class="text-gray-500">Due Date:</span>
                    <span><?php echo e($invoice->checkout_at->format('d M, y')); ?></span>
                </p>
                <p class="flex  justify-between">
                    <span class="text-gray-500">Status:</span>
                    <span
                        class="px-2 py-1 rounded text-white uppercase text-xs <?php echo e($invoice->status == "unpaid" ? 'bg-red-600': 'bg-green-600'); ?>"><?php echo e($invoice->status); ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="flex justify-between"></div>
</div><?php /**PATH /Users/user/Documents/projects/hbs/resources/views/livewire/consultation/show.blade.php ENDPATH**/ ?>