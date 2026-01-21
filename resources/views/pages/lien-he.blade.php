 @extends('layouts.app')

 @section('title', 'Liên Hệ')

 @section('content')
     <!-- Single Page Header start -->
     <div class="container-fluid page-header py-5">
         <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Liên hệ</h1>
         <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
             <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
             <li class="breadcrumb-item active text-white">Liên hệ</li>
         </ol>
     </div>
     <!-- Single Page Header End -->

     <!-- Contucts Start -->
     <div class="container-fluid contact py-5">
         <div class="container py-5">
             <div class="p-5 bg-light rounded">
                 <div class="row g-4">
                     <div class="col-12">
                         <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                             <h4 class="text-primary border-bottom border-primary border-2 d-inline-block pb-2">Liên hệ với chúng tôi</h4>
                             <p class="mb-5 fs-5 text-dark">Chúng tôi luôn sẵn sàng hỗ trợ bạn!
                             </p>
                         </div>
                     </div>
                     <div class="col-lg-7">
                         <h5 class="text-primary wow fadeInUp" data-wow-delay="0.1s">Kết nối</h5>
                         <h1 class="display-5 mb-4 wow fadeInUp" data-wow-delay="0.3s">Gửi tin nhắn cho chúng tôi</h1>
                         <p class="mb-4 wow fadeInUp" data-wow-delay="0.5s">Hãy điền thông tin vào form bên dưới, chúng tôi sẽ phản hồi trong thời gian sớm nhất.</p>
                         {{-- cập nhập lại form --}}
                         <form action="{{ route('contact.store') }}" method="POST">
                             @csrf
                             @if ($errors->any())
                                 <div class="alert alert-danger">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                 </div>
                             @endif

                             @if (session('success'))
                                 <div class="alert alert-success">{{ session('success') }}</div>
                             @endif

                             <div class="row g-4 wow fadeInUp" data-wow-delay="0.1s">
                                 <div class="col-lg-12 col-xl-6">
                                     <div class="form-floating">
                                         <input type="text" class="form-control @error('name') is-invalid @enderror"
                                             id="name" name="name" placeholder="Your Name"
                                             value="{{ old('name') }}" required>
                                         <label for="name">Họ và tên</label>
                                         @error('name')
                                             <span class="text-danger small">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="col-lg-12 col-xl-6">
                                     <div class="form-floating">
                                         <input type="email" class="form-control @error('email') is-invalid @enderror"
                                             id="email" name="email" placeholder="Your Email"
                                             value="{{ old('email') }}" required>
                                         <label for="email">Email</label>
                                         @error('email')
                                             <span class="text-danger small">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="col-lg-12 col-xl-6">
                                     <div class="form-floating">
                                         <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                             id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}"
                                             required>
                                         <label for="phone">Số điện thoại</label>
                                         @error('phone')
                                             <span class="text-danger small">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="col-lg-12 col-xl-6">
                                     <div class="form-floating">
                                         <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                             id="subject" name="subject" placeholder="Subject"
                                             value="{{ old('subject') }}" required>
                                         <label for="subject">Subject(VD: Tên sản phẩm)</label>
                                         @error('subject')
                                             <span class="text-danger small">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-floating">
                                         <textarea class="form-control @error('message') is-invalid @enderror" placeholder="Leave a message here" id="message"
                                             name="message" style="height: 160px" required>{{ old('message') }}</textarea>
                                         <label for="message">Nội dung</label>
                                         @error('message')
                                             <span class="text-danger small">{{ $message }}</span>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <button type="submit" class="btn btn-primary w-100 py-3">Gửi tin nhắn</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                     <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.2s">
                         <div class="h-100 rounded">
                             <iframe class="rounded w-100" style="height: 100%;"
                                 src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3111.1127224269576!2d106.70025397817284!3d10.753270430633794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f900a55c3b5%3A0xc839fac447a91cd0!2zTMaw4bujbmcgU3BvcnQ!5e0!3m2!1svi!2s!4v1768987081481!5m2!1svi!2s"
                                 loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                         </div>
                     </div>
                     <div class="col-lg-12">
                         <div class="row g-4 align-items-center justify-content-center">



                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- Contuct End -->
 @endsection
