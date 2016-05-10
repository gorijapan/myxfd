# MyXFD

```
curl -H "Content-type: application/json" -X PUT -d '{"flag":"failure"}' http://example.com/ci
{"result":"failure"}

curl -X GET http://example.com/ci
{"result":"failure"}
```