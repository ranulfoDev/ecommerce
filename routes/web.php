    <?php

    use Illuminate\Http\Request;
    use App\Http\Controllers\Auth\AuthController;
    use App\Http\Controllers\Auth\ForgotPasswordController;
    use App\Http\Controllers\Auth\ResetPasswordController;
    use Laravel\Socialite\Facades\Socialite;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;
    use App\Models\User;


    use App\Http\Controllers\Admin\DashboardController;
    use App\Http\Controllers\Admin\UserController;
    use App\Http\Controllers\Admin\ProductController;
    use App\Http\Controllers\Admin\CategoryController;
    use App\Http\Controllers\Admin\OrderController;
    use App\Http\Controllers\Admin\PaymentController;
    use App\Http\Controllers\Admin\PayPalCallbackController;
    use App\Http\Controllers\Admin\CouponController;
    use App\Http\Controllers\Admin\ReviewController;
    use App\Http\Controllers\Admin\ReportController;
    use App\Http\Controllers\Admin\ProfileController;
    use App\Http\Controllers\Admin\SettingsController;



    use App\Http\Controllers\User\UserController as UserUserController;
    use App\Http\Controllers\User\DashboardController as UserDashboardController;
    use App\Http\Controllers\User\ProductController as UserProductController;
    use App\Http\Controllers\User\CartController;
    use App\Http\Controllers\User\CheckoutController;
    use App\Http\Controllers\User\OrderController as UserOrderController;
    use App\Http\Controllers\User\AnalyticsController;
    use App\Http\Controllers\User\ReviewController as UserReviewController;
    use App\Http\Controllers\CouponApplyController;

    Route::get('/', function () {
        return view('landing');
    })->name('landing');

    // HOME PAGE
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // PRODUCTS PAGE
    Route::get('/products', function () {
        return view('products');
    })->name('products');

    Route::get('/products/{id}', function ($id) {
        return view('product-details', compact('id'));
    })->name('products.show');


    Route::controller(AuthController::class)->group(function () {

        Route::get('/login', 'showLogin')->name('login');
        Route::get('/register', 'showRegister')->name('register');

        Route::post('/login', 'login')->name('login.store');
        Route::post('/register', 'register')->name('register.store');

        Route::post('/logout', 'logout')->name('logout');

    });
    
    
    // 🔐 Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

    // 🔑 Reset Password
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

   
   Route::post('/apply-coupon', [CouponApplyController::class, 'apply']);



Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
    
       Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

       Route::get('/users', [UserController::class, 'index'])->name('users.index');
       Route::get('/users/{id}/block', [UserController::class, 'block'])->name('users.block');
       Route::get('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
       Route::get('/users/{id}/orders', [UserController::class, 'orders'])->name('users.orders');
       Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

       Route::resource('products', ProductController::class);

       Route::resource('categories', CategoryController::class)->except(['create','edit']);

       Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
       Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
       Route::get('/orders/{order}/status/{status}', [OrderController::class, 'updateStatus'])->name('orders.status');
       Route::get('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // ✅ PAYMENTS - WALANG DUPLICATE
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify');
        Route::get('/payments/{payment}/refund', [PaymentController::class, 'refund'])->name('payments.refund');
        Route::post('/paypal-callback', [PayPalCallbackController::class, 'callback'])->name('paypal.callback');

        Route::resource('coupons', CouponController::class)->only(['index','store','destroy']);

        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.delete');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/settings', [SettingsController::class, 'index'])->name('settings'); 

});


    Route::prefix('user')
        ->middleware(['auth'])
        ->name('user.')
        ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        Route::post('/review/store', [UserReviewController::class, 'store'])->name('review.store');

        Route::get('/profile', [UserUserController::class, 'profile'])->name('profile');
        Route::get('/settings', [UserUserController::class, 'settings'])->name('settings'); 

        Route::post('/update-profile', [UserUserController::class, 'updateProfile'])->name('updateProfile'); 
        Route::post('/change-password', [UserUserController::class, 'changePassword'])->name('changePassword');

        Route::resource('products', UserProductController::class);

        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('placeOrder');
        Route::post('/place-order-paypal', [CheckoutController::class, 'paypalOrder']);
        
       Route::get('/orders', [UserOrderController::class, 'index'])->name('orders');
       Route::get('/orders/{id}', [UserOrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{id}/cancel', [UserOrderController::class, 'cancel'])->name('orders.cancel');
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

    });