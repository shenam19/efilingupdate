<?php if (isset($component)) { $__componentOriginal74bf5c5ceb04ec08d68cbab7bf77439b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74bf5c5ceb04ec08d68cbab7bf77439b = $attributes; } ?>
<?php $component = App\View\Components\HomeLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('home-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\HomeLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="login-page">
        <div class="banner">
            <div class="message">
                <img src="<?php echo e(asset('img/cta_logo_red.png')); ?>" class="logo">
                <h1 class="welcoming">བོད་མིའི་སྒྲིག་འཛུགས་ཀྱི་གློག་འཕྲུལ་ཡིག་ཚགས་ལ་ཕེབས་པར་དགའ་བསུ་ཞུ།</h1>
            </div>
        </div>

        <div class="login">
            <div class="login-card">
                <div>
                    <?php if (isset($component)) { $__componentOriginal522a59481d8bfd4d44478643bc3270fb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal522a59481d8bfd4d44478643bc3270fb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'vendor.jetstream.components.validation-errors','data' => ['class' => 'text-danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('jet-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal522a59481d8bfd4d44478643bc3270fb)): ?>
<?php $attributes = $__attributesOriginal522a59481d8bfd4d44478643bc3270fb; ?>
<?php unset($__attributesOriginal522a59481d8bfd4d44478643bc3270fb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal522a59481d8bfd4d44478643bc3270fb)): ?>
<?php $component = $__componentOriginal522a59481d8bfd4d44478643bc3270fb; ?>
<?php unset($__componentOriginal522a59481d8bfd4d44478643bc3270fb); ?>
<?php endif; ?>
                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="login-field">
                            <input type="email" class="e-input-control" placeholder="<?php echo e(__('སྤྱོད་མིང་ངོ་རྟགས།')); ?>"
                                name="email" value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="login-field">
                            <input type="password" class="e-input-control" placeholder="<?php echo e(__('གསང་ཚིག།')); ?>"
                                name="password">
                        </div>
                        <div class="login-field">
                            <div>
                                <div class="icheck-primary">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div>
                                <button type="submit" class="e-input-control"><?php echo e(__('ནང་འཛུལ་བྱོས།')); ?></button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p>
                        <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>"><?php echo e(__('གསང་ཚིག་དྲན་པ་བརྗེད་ན་འདིར་སྣོན།')); ?></a>
                        <?php endif; ?>
                    </p>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="footer">
                <ul>
                    <li><a href="<?php echo e(url('documentation/welcome')); ?>">བཀོལ་སྤྱོད་ལམ་སྟོན།</a></li>
                    <li><a href="<?php echo e(url('documentation/faq')); ?>">བསྐྱར་འདྲི་ཡང་འདྲིའི་དྲི་བ།</a></li>
                </ul>

                <p class="claim">v1.0 | Built & maintained by TCRC 👩🏻‍💻</p>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74bf5c5ceb04ec08d68cbab7bf77439b)): ?>
<?php $attributes = $__attributesOriginal74bf5c5ceb04ec08d68cbab7bf77439b; ?>
<?php unset($__attributesOriginal74bf5c5ceb04ec08d68cbab7bf77439b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74bf5c5ceb04ec08d68cbab7bf77439b)): ?>
<?php $component = $__componentOriginal74bf5c5ceb04ec08d68cbab7bf77439b; ?>
<?php unset($__componentOriginal74bf5c5ceb04ec08d68cbab7bf77439b); ?>
<?php endif; ?>
<?php /**PATH /Users/shenam/efilingupdate/resources/views/auth/login.blade.php ENDPATH**/ ?>