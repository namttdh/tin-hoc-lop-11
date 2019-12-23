; ModuleID = 'units/kbd.c'
source_filename = "units/kbd.c"
target datalayout = "e-m:e-i64:64-f80:128-n8:16:32:64-S128"
target triple = "x86_64-pc-linux-gnu"

%struct._IO_FILE = type { i32, i8*, i8*, i8*, i8*, i8*, i8*, i8*, i8*, i8*, i8*, i8*, %struct._IO_marker*, %struct._IO_FILE*, i32, i32, i64, i16, i8, [1 x i8], i8*, i64, %struct._IO_codecvt*, %struct._IO_wide_data*, %struct._IO_FILE*, i8*, i64, i32, [20 x i8] }
%struct._IO_marker = type opaque
%struct._IO_codecvt = type opaque
%struct._IO_wide_data = type opaque
%struct.termios = type { i32, i32, i32, i32, i8, [32 x i8], i32, i32 }
%struct.timeval = type { i64, i64 }
%struct.fd_set = type { [16 x i64] }

@escape_state = dso_local global i32 0, align 4
@.str = private unnamed_addr constant [2 x i8] c"\0A\00", align 1
@.str.1 = private unnamed_addr constant [3 x i8] c"%c\00", align 1
@stdout = external dso_local global %struct._IO_FILE*, align 8

; Function Attrs: noinline nounwind optnone uwtable
define dso_local void @termios_restore(i8*) #0 {
  %2 = alloca i8*, align 8
  store i8* %0, i8** %2, align 8
  %3 = load i8*, i8** %2, align 8
  %4 = bitcast i8* %3 to %struct.termios*
  %5 = call i32 @tcsetattr(i32 0, i32 0, %struct.termios* %4) #4
  ret void
}

; Function Attrs: nounwind
declare dso_local i32 @tcsetattr(i32, i32, %struct.termios*) #1

; Function Attrs: noinline nounwind optnone uwtable
define dso_local void @termios_cleanup(i32, i8*) #0 {
  %3 = alloca i32, align 4
  %4 = alloca i8*, align 8
  store i32 %0, i32* %3, align 4
  store i8* %1, i8** %4, align 8
  %5 = load i8*, i8** %4, align 8
  call void @termios_restore(i8* %5)
  %6 = load i8*, i8** %4, align 8
  call void @free(i8* %6) #4
  ret void
}

; Function Attrs: nounwind
declare dso_local void @free(i8*) #1

; Function Attrs: noinline nounwind optnone uwtable
define dso_local %struct.termios* @termios_raw() #0 {
  %1 = alloca %struct.termios*, align 8
  %2 = alloca %struct.termios, align 4
  %3 = call noalias i8* @malloc(i64 60) #4
  %4 = bitcast i8* %3 to %struct.termios*
  store %struct.termios* %4, %struct.termios** %1, align 8
  %5 = load %struct.termios*, %struct.termios** %1, align 8
  %6 = call i32 @tcgetattr(i32 0, %struct.termios* %5) #4
  %7 = load %struct.termios*, %struct.termios** %1, align 8
  %8 = bitcast %struct.termios* %7 to i8*
  %9 = call i32 @on_exit(void (i32, i8*)* @termios_cleanup, i8* %8) #4
  %10 = bitcast %struct.termios* %2 to i8*
  %11 = load %struct.termios*, %struct.termios** %1, align 8
  %12 = bitcast %struct.termios* %11 to i8*
  call void @llvm.memcpy.p0i8.p0i8.i64(i8* align 4 %10, i8* align 4 %12, i64 60, i1 false)
  call void @cfmakeraw(%struct.termios* %2) #4
  %13 = getelementptr inbounds %struct.termios, %struct.termios* %2, i32 0, i32 1
  %14 = load i32, i32* %13, align 4
  %15 = or i32 %14, 1
  store i32 %15, i32* %13, align 4
  %16 = call i32 @tcsetattr(i32 0, i32 0, %struct.termios* %2) #4
  %17 = load %struct.termios*, %struct.termios** %1, align 8
  ret %struct.termios* %17
}

; Function Attrs: nounwind
declare dso_local noalias i8* @malloc(i64) #1

; Function Attrs: nounwind
declare dso_local i32 @tcgetattr(i32, %struct.termios*) #1

; Function Attrs: nounwind
declare dso_local i32 @on_exit(void (i32, i8*)*, i8*) #1

; Function Attrs: argmemonly nounwind
declare void @llvm.memcpy.p0i8.p0i8.i64(i8* nocapture writeonly, i8* nocapture readonly, i64, i1) #2

; Function Attrs: nounwind
declare dso_local void @cfmakeraw(%struct.termios*) #1

; Function Attrs: noinline nounwind optnone uwtable
define dso_local i32 @kbd_pending() #0 {
  %1 = alloca %struct.timeval, align 8
  %2 = alloca %struct.fd_set, align 8
  %3 = alloca i32, align 4
  %4 = alloca %struct.fd_set*, align 8
  %5 = bitcast %struct.timeval* %1 to i8*
  call void @llvm.memset.p0i8.i64(i8* align 8 %5, i8 0, i64 16, i1 false)
  br label %6

; <label>:6:                                      ; preds = %0
  store %struct.fd_set* %2, %struct.fd_set** %4, align 8
  store i32 0, i32* %3, align 4
  br label %7

; <label>:7:                                      ; preds = %17, %6
  %8 = load i32, i32* %3, align 4
  %9 = zext i32 %8 to i64
  %10 = icmp ult i64 %9, 16
  br i1 %10, label %11, label %20

; <label>:11:                                     ; preds = %7
  %12 = load %struct.fd_set*, %struct.fd_set** %4, align 8
  %13 = getelementptr inbounds %struct.fd_set, %struct.fd_set* %12, i32 0, i32 0
  %14 = load i32, i32* %3, align 4
  %15 = zext i32 %14 to i64
  %16 = getelementptr inbounds [16 x i64], [16 x i64]* %13, i64 0, i64 %15
  store i64 0, i64* %16, align 8
  br label %17

; <label>:17:                                     ; preds = %11
  %18 = load i32, i32* %3, align 4
  %19 = add i32 %18, 1
  store i32 %19, i32* %3, align 4
  br label %7

; <label>:20:                                     ; preds = %7
  br label %21

; <label>:21:                                     ; preds = %20
  %22 = getelementptr inbounds %struct.fd_set, %struct.fd_set* %2, i32 0, i32 0
  %23 = getelementptr inbounds [16 x i64], [16 x i64]* %22, i64 0, i64 0
  %24 = load i64, i64* %23, align 8
  %25 = or i64 %24, 1
  store i64 %25, i64* %23, align 8
  %26 = call i32 @select(i32 1, %struct.fd_set* %2, %struct.fd_set* null, %struct.fd_set* null, %struct.timeval* %1)
  ret i32 %26
}

; Function Attrs: argmemonly nounwind
declare void @llvm.memset.p0i8.i64(i8* nocapture writeonly, i8, i64, i1) #2

declare dso_local i32 @select(i32, %struct.fd_set*, %struct.fd_set*, %struct.fd_set*, %struct.timeval*) #3

; Function Attrs: noinline nounwind optnone uwtable
define dso_local i32 @readkey() #0 {
  %1 = alloca i32, align 4
  %2 = alloca i32, align 4
  %3 = alloca i8, align 1
  %4 = call i64 @read(i32 0, i8* %3, i64 1)
  %5 = trunc i64 %4 to i32
  store i32 %5, i32* %2, align 4
  %6 = icmp slt i32 %5, 1
  br i1 %6, label %7, label %8

; <label>:7:                                      ; preds = %0
  store i32 -1, i32* %1, align 4
  br label %46

; <label>:8:                                      ; preds = %0
  %9 = load i32, i32* @escape_state, align 4
  %10 = icmp eq i32 %9, 27
  br i1 %10, label %11, label %29

; <label>:11:                                     ; preds = %8
  %12 = load i8, i8* %3, align 1
  %13 = zext i8 %12 to i32
  %14 = icmp eq i32 %13, 79
  br i1 %14, label %19, label %15

; <label>:15:                                     ; preds = %11
  %16 = load i8, i8* %3, align 1
  %17 = zext i8 %16 to i32
  %18 = icmp eq i32 %17, 91
  br i1 %18, label %19, label %29

; <label>:19:                                     ; preds = %15, %11
  store i32 0, i32* @escape_state, align 4
  %20 = call i32 @readkey()
  %21 = trunc i32 %20 to i8
  store i8 %21, i8* %3, align 1
  %22 = load i8, i8* %3, align 1
  %23 = zext i8 %22 to i32
  switch i32 %23, label %28 [
    i32 65, label %24
    i32 66, label %25
    i32 67, label %26
    i32 68, label %27
  ]

; <label>:24:                                     ; preds = %19
  store i8 72, i8* %3, align 1
  br label %28

; <label>:25:                                     ; preds = %19
  store i8 80, i8* %3, align 1
  br label %28

; <label>:26:                                     ; preds = %19
  store i8 77, i8* %3, align 1
  br label %28

; <label>:27:                                     ; preds = %19
  store i8 75, i8* %3, align 1
  br label %28

; <label>:28:                                     ; preds = %19, %27, %26, %25, %24
  br label %43

; <label>:29:                                     ; preds = %15, %8
  %30 = load i32, i32* @escape_state, align 4
  %31 = icmp eq i32 %30, 27
  br i1 %31, label %32, label %33

; <label>:32:                                     ; preds = %29
  store i32 0, i32* @escape_state, align 4
  br label %42

; <label>:33:                                     ; preds = %29
  %34 = load i8, i8* %3, align 1
  %35 = zext i8 %34 to i32
  %36 = icmp eq i32 %35, 27
  br i1 %36, label %37, label %41

; <label>:37:                                     ; preds = %33
  %38 = call i32 @kbd_pending()
  %39 = icmp ne i32 %38, 0
  br i1 %39, label %40, label %41

; <label>:40:                                     ; preds = %37
  store i32 27, i32* @escape_state, align 4
  store i8 0, i8* %3, align 1
  br label %41

; <label>:41:                                     ; preds = %40, %37, %33
  br label %42

; <label>:42:                                     ; preds = %41, %32
  br label %43

; <label>:43:                                     ; preds = %42, %28
  %44 = load i8, i8* %3, align 1
  %45 = zext i8 %44 to i32
  store i32 %45, i32* %1, align 4
  br label %46

; <label>:46:                                     ; preds = %43, %7
  %47 = load i32, i32* %1, align 4
  ret i32 %47
}

declare dso_local i64 @read(i32, i8*, i64) #3

; Function Attrs: noinline nounwind optnone uwtable
define dso_local i32 @readstr(i8*, i32) #0 {
  %3 = alloca i32, align 4
  %4 = alloca i8*, align 8
  %5 = alloca i32, align 4
  %6 = alloca i32, align 4
  %7 = alloca i32, align 4
  %8 = alloca i32, align 4
  store i8* %0, i8** %4, align 8
  store i32 %1, i32* %5, align 4
  store i32 0, i32* %6, align 4
  store i32 0, i32* %7, align 4
  %9 = load i32, i32* %5, align 4
  %10 = icmp eq i32 %9, 0
  br i1 %10, label %11, label %12

; <label>:11:                                     ; preds = %2
  store i32 0, i32* %3, align 4
  br label %62

; <label>:12:                                     ; preds = %2
  br label %13

; <label>:13:                                     ; preds = %55, %12
  %14 = load i32, i32* %6, align 4
  %15 = load i32, i32* %5, align 4
  %16 = sub nsw i32 %15, 1
  %17 = icmp slt i32 %14, %16
  br i1 %17, label %18, label %56

; <label>:18:                                     ; preds = %13
  %19 = call i32 @readkey()
  store i32 %19, i32* %8, align 4
  %20 = load i32, i32* %8, align 4
  switch i32 %20, label %22 [
    i32 -1, label %21
    i32 8, label %21
    i32 10, label %21
    i32 13, label %21
    i32 32, label %21
  ]

; <label>:21:                                     ; preds = %18, %18, %18, %18, %18
  store i32 1, i32* %7, align 4
  br label %31

; <label>:22:                                     ; preds = %18
  %23 = load i32, i32* %8, align 4
  %24 = trunc i32 %23 to i8
  %25 = load i8*, i8** %4, align 8
  %26 = load i32, i32* %6, align 4
  %27 = sext i32 %26 to i64
  %28 = getelementptr inbounds i8, i8* %25, i64 %27
  store i8 %24, i8* %28, align 1
  %29 = load i32, i32* %6, align 4
  %30 = add nsw i32 %29, 1
  store i32 %30, i32* %6, align 4
  br label %31

; <label>:31:                                     ; preds = %22, %21
  %32 = call i32 @isatty(i32 0) #4
  %33 = icmp ne i32 %32, 0
  br i1 %33, label %34, label %51

; <label>:34:                                     ; preds = %31
  %35 = load i32, i32* %8, align 4
  %36 = icmp ugt i32 %35, 0
  br i1 %36, label %37, label %51

; <label>:37:                                     ; preds = %34
  %38 = load i32, i32* %8, align 4
  %39 = icmp eq i32 %38, 10
  br i1 %39, label %43, label %40

; <label>:40:                                     ; preds = %37
  %41 = load i32, i32* %8, align 4
  %42 = icmp eq i32 %41, 13
  br i1 %42, label %43, label %45

; <label>:43:                                     ; preds = %40, %37
  %44 = call i32 (i8*, ...) @printf(i8* getelementptr inbounds ([2 x i8], [2 x i8]* @.str, i32 0, i32 0))
  br label %48

; <label>:45:                                     ; preds = %40
  %46 = load i32, i32* %8, align 4
  %47 = call i32 (i8*, ...) @printf(i8* getelementptr inbounds ([3 x i8], [3 x i8]* @.str.1, i32 0, i32 0), i32 %46)
  br label %48

; <label>:48:                                     ; preds = %45, %43
  %49 = load %struct._IO_FILE*, %struct._IO_FILE** @stdout, align 8
  %50 = call i32 @fflush(%struct._IO_FILE* %49)
  br label %51

; <label>:51:                                     ; preds = %48, %34, %31
  %52 = load i32, i32* %7, align 4
  %53 = icmp ne i32 %52, 0
  br i1 %53, label %54, label %55

; <label>:54:                                     ; preds = %51
  br label %56

; <label>:55:                                     ; preds = %51
  br label %13

; <label>:56:                                     ; preds = %54, %13
  %57 = load i8*, i8** %4, align 8
  %58 = load i32, i32* %6, align 4
  %59 = sext i32 %58 to i64
  %60 = getelementptr inbounds i8, i8* %57, i64 %59
  store i8 0, i8* %60, align 1
  %61 = load i32, i32* %6, align 4
  store i32 %61, i32* %3, align 4
  br label %62

; <label>:62:                                     ; preds = %56, %11
  %63 = load i32, i32* %3, align 4
  ret i32 %63
}

; Function Attrs: nounwind
declare dso_local i32 @isatty(i32) #1

declare dso_local i32 @printf(i8*, ...) #3

declare dso_local i32 @fflush(%struct._IO_FILE*) #3

; Function Attrs: noinline nounwind optnone uwtable
define dso_local i32 @raw_scanf(i8*, i8*) #0 {
  %3 = alloca i8*, align 8
  %4 = alloca i8*, align 8
  %5 = alloca [256 x i8], align 16
  store i8* %0, i8** %3, align 8
  store i8* %1, i8** %4, align 8
  %6 = getelementptr inbounds [256 x i8], [256 x i8]* %5, i32 0, i32 0
  %7 = call i32 @readstr(i8* %6, i32 256)
  %8 = getelementptr inbounds [256 x i8], [256 x i8]* %5, i32 0, i32 0
  %9 = load i8*, i8** %3, align 8
  %10 = load i8*, i8** %4, align 8
  %11 = call i32 (i8*, i8*, ...) @__isoc99_sscanf(i8* %8, i8* %9, i8* %10) #4
  ret i32 %11
}

; Function Attrs: nounwind
declare dso_local i32 @__isoc99_sscanf(i8*, i8*, ...) #1

attributes #0 = { noinline nounwind optnone uwtable "correctly-rounded-divide-sqrt-fp-math"="false" "disable-tail-calls"="false" "less-precise-fpmad"="false" "min-legal-vector-width"="0" "no-frame-pointer-elim"="true" "no-frame-pointer-elim-non-leaf" "no-infs-fp-math"="false" "no-jump-tables"="false" "no-nans-fp-math"="false" "no-signed-zeros-fp-math"="false" "no-trapping-math"="false" "stack-protector-buffer-size"="8" "target-cpu"="x86-64" "target-features"="+fxsr,+mmx,+sse,+sse2,+x87" "unsafe-fp-math"="false" "use-soft-float"="false" }
attributes #1 = { nounwind "correctly-rounded-divide-sqrt-fp-math"="false" "disable-tail-calls"="false" "less-precise-fpmad"="false" "no-frame-pointer-elim"="true" "no-frame-pointer-elim-non-leaf" "no-infs-fp-math"="false" "no-nans-fp-math"="false" "no-signed-zeros-fp-math"="false" "no-trapping-math"="false" "stack-protector-buffer-size"="8" "target-cpu"="x86-64" "target-features"="+fxsr,+mmx,+sse,+sse2,+x87" "unsafe-fp-math"="false" "use-soft-float"="false" }
attributes #2 = { argmemonly nounwind }
attributes #3 = { "correctly-rounded-divide-sqrt-fp-math"="false" "disable-tail-calls"="false" "less-precise-fpmad"="false" "no-frame-pointer-elim"="true" "no-frame-pointer-elim-non-leaf" "no-infs-fp-math"="false" "no-nans-fp-math"="false" "no-signed-zeros-fp-math"="false" "no-trapping-math"="false" "stack-protector-buffer-size"="8" "target-cpu"="x86-64" "target-features"="+fxsr,+mmx,+sse,+sse2,+x87" "unsafe-fp-math"="false" "use-soft-float"="false" }
attributes #4 = { nounwind }

!llvm.module.flags = !{!0}
!llvm.ident = !{!1}

!0 = !{i32 1, !"wchar_size", i32 4}
!1 = !{!"clang version 8.0.0-3 (tags/RELEASE_800/final)"}
