# IDisT\Image_Checker

Package kiểm tra định dạng file ảnh không phụ thuộc vào extension của file

## Usage

- Khởi tạo đối tượng với đầu vào là  path local đến file hoặc 1 đường link web, cũng có thể là source/resource.


```
$image = new \IDisT\ImageChecker\Image($path);
```

- Có thể truyền đường dẫn file ảnh ngay từ khi khởi tạo đối tượng Image.
- Nếu không truyền trực tiếp thì có thể sử dụng phương thức download trong Class Image để detech lại ảnh.

```
$image->download($path);
```

- Lấy định dạng thực của ảnh. Hiện chỉ có thể detect được GIF, JPG, PNG, TIFF( một số file ), BMP

```
$image->getType();

```
 
- Kiểm tra file ảnh có thuộc định dạng mong muốn không

```
$image->isGIF();
$image->isBMP();

``` 

Mở rộng thêm các định dạng khác, tham khảo tại [File Signature](https://www.garykessler.net/library/file_sigs.html?utm_source=tool.lu)