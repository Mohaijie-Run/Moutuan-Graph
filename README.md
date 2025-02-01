## 项目开发原因？

> 本项目仅供学习和参考使用，若因此产生任何问题，我们不承担责任。

我们开发这个项目是为了应对网站图片总量大、加载速度慢的问题。市面上虽然有一些公益免费的图床或小型云存储服务，但它们的稳定性常常难以保障。因此，我们通过直接接入某大厂的图传API接口，提供更加稳定高效的图片云存储解决方案，确保图片上传和加载的速度与可靠性。

## 食用APIの方法？

```html
<form action="YOUR-API-ADDRESS" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" accept="*/*" required />
    <button type="submit">上传文件</button>
</form>

以上是一个HTML发送请求上传图片的示例。该HTML代码定义了一个上传文件的表单，使用`<form>`标签。  
- `action="YOUR-API-ADDRESS"`指定表单数据提交的API地址。  
- `method="POST"`表示使用POST方法提交表单数据。  
- `enctype="multipart/form-data"`用于指定表单将以多部分数据格式发送，支持文件上传。  
- `<input type="file" name="file" accept="*/*" required />`创建了一个文件选择输入框，`accept="*/*"`允许选择任何类型的文件，`required`表示此字段为必填项。  
- `<button type="submit">上传文件</button>`是提交按钮，用户点击后上传文件。
